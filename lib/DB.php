<?php

/**
 * Database class
 *
 * @author Peter Donders
 * @version 1.0.0
 *
 * Changelog
 * 1.0.0
 * 		Eerste versie
 */


class DB {

    protected $linkID = 0;		   // Result of mysql_connect()
    protected $debugNextQuery = false;
    protected static $instance;
	protected static $instances = array();

    public function __construct(
        protected string $host, 
        protected string $user,
        protected string $password,
        protected string $database) {


        }



    /**
	 * Get a Singleton Db instance
	 *
	 * @param string $type
	 * @param string $host
	 * @param string $database
	 * @param string $user
	 * @param string $password
	 * @return Db
	 */
	public static function &loadDb($host = "",$database = "",$user = "",$password = "", $type = "mysqli")
	{
		if (!strlen($host))
		{
			$hosts = array_keys(self::$instances);
			$host = reset($hosts);
		}

		if (!strlen($database))
		{
			$databases = array_keys(self::$instances[$host]);
			$database = reset($databases);
		}

		if (!isset(self::$instances[$host][$database]))
		{
			self::$instances[$host][$database] = new self($host, $user, $password, $database);
		}
		
		return self::$instances[$host][$database];
	}



    /**
	 * Connect to the server
	 *
	 * @return int|false
	 */
	public function connect()
	{
		if ($this->linkID)
			return $this->linkID;

		$this->linkID = mysqli_connect($this->host, $this->user, $this->password, $this->database);

		if (!$this->linkID) {
			die('Fatal Error: Could not connect to database server, please check the configuration');
		}

		$this->query('SET sql_mode="";');
		

		return $this->linkID;
	}

    /**
	 * Execute a query
	 * Wrapper function for execute, so backtraces in logging will be consistent.
	 *
	 * @param string $query
	 * @return bool
	 */
	public function query($query)
	{
		return $this->execute($query);
	}

    /**
	 * Execute the given query. Only accessable within DB.
	 *
	 * @param string $query
	 * @return bool
	 */
	protected function execute($query)
	{
		$this->connect();

		$startTime = array_sum(explode(" ",microtime()));

		$this->lastQuery = $query;
		$this->queryID = mysqli_query($this->linkID, $query);

		$endTime = array_sum(explode(" ",microtime()));
		$time = $endTime - $startTime;

		$this->row			= 0;
		$this->errorID		= mysqli_errno($this->linkID);
		$this->errorMessage	= mysqli_error($this->linkID);

		if ($this->debugNextQuery)
		{
			$this->debugQuery();
			$this->debugNextQuery = false;
		}

		if (!$this->queryID)
		{
			$this->halt("Invalid SQL: \"".$query."\"");
			return false;
		}

		return $this->queryID;
	}

    /**
	 * Get the next record of a select query
	 *
	 * @param bool $reset return the internal pointer to begin of the result set?
	 * @return mixed Results
	 */
	public function nextRecord($reset = true)
	{
		if (!$this->queryID)
			return null;

		$this->record = mysqli_fetch_assoc($this->queryID);

		

		$this->row++;
		$this->errorID		= mysqli_errno($this->linkID);
		$this->errorMessage	= mysqli_error($this->linkID);

		if ($reset && !Validator::isArray($this->record))
		{
			mysqli_free_result($this->queryID);
			$this->queryID = 0;
		}
		elseif (!Validator::isArray($this->record) && $this->numRows())
		{
			mysqli_data_seek($this->queryID, 0);
			$this->row = 0;
		}
		return $this->record;
	}

    // TODO:: MAKE IT WORK
	/**
	 * Free the memory used by a result
	 *
	 */
	public function cleanResults()
	{
		//mysqli_free_result($this->queryID);
	}

	/**
	 * Return the last autoincrement ID
	 * after INSERT or REPLACE queries
	 *
	 * @return unknown
	 */
	public function insertID()
	{
		return mysqli_insert_id($this->linkID);
	}



    /**
	 * Select rows from the database
	 * Executes query $query and returns the result as array of objects
	 *
	 * @param string $query
	 * @param string $class
	 * @param string $rowKeyField What field to use as key in the returned array
	 * @return mixed
	 */
	public function selectObjects($query, $class = "stdClass", $rowKeyField = "")
	{
        $this->connect();

		if (!Validator::isString($class))
			$class = "stdClass";

		$resultset = $this->execute($query);
		if ($resultset === false) {
			return false;
		}

		$result = array();
		while ($array = $this->nextRecord())
		{
			if (!Validator::isArray($array, false))
			{
				return false;
			}

			$object = new $class();

			$keys = array_keys($array);
			foreach($keys as $index => $key)
				$object->$key = $array[$key];

			if (method_exists($object, '__afterDBLoad'))
				$object->__afterDBLoad();

			if (Validator::isString($rowKeyField) && isset($object->$rowKeyField))
				$result[$array[$rowKeyField]] = $object;
			else
				$result[] = $object;
		}
		$this->cleanResults();
        return $result;
	}

    /**
	 * Select a single row from the database
	 * Executes query $query and retuns the first result as object
	 *
	 * @param string $query
	 * @param string $class
	 * @return mixed
	 */
	public function selectObject($query, $class = "stdClass")
	{
		$this->connect();

		$object = new $class();

		$resultset = $this->execute($query);
		if ($resultset === false)
		{
			return $object;
		}

		$result = array();
		$array = $this->nextRecord();

		if (!Validator::isArray($array, false))
		{
			return $object;
		}

		$keys = array_keys($array);
		foreach($keys as $index => $key)
			$object->$key = $array[$key];

		if (method_exists($object, '__afterDBLoad'))
			$object->__afterDBLoad();

		$this->cleanResults();

		return $object;
	}


	/**
	 * Updates rows in one or more tables
	 *
	 * @param mixed $tables Array or comma separated string with tables
	 * @param mixed $data
	 * @param string $where WHERE-clause
	 * @return bool
	 */
	public function update($tables, $object, $where = '')
	{
		$this->connect();

		if (Validator::isObject($object))
		{
			if (method_exists($object, '__beforeDBSave'))
				$object->__beforeDBSave();
			elseif (method_exists($object, '__cleanup'))
				$object->__cleanup();
			$data = get_object_vars($object);
		}
		else
			$data = $object;

		if (!Validator::isArray($data, false))
			return false;

		if (Validator::isArray($tables))
			$tables = implode(",", $tables);

		if (!Validator::isString($tables))
			return false;

		$tables = str_replace(", ", ",", $tables);
		$tables = str_replace(",", "`,`", $tables);
		$tables = "`".$tables."`";

		$values = array();
		foreach($data as $key => $value)
		{
			if (is_array($value) || is_object($value))
				continue;

			$value = $this->escapeForSql($value);
			$values[] = "`".str_replace(".", "`.`", $key)."`= $value";
		}

		$values = implode(",", $values);

		$sql = "UPDATE $tables SET ".$values." WHERE ".$where;
		$result = $this->execute($sql);

		if (Validator::isObject($object) && method_exists($object, '__afterDBSave'))
			$object->__afterDBSave();

		return $result;
	}

	/**
	 * Escape a string to be used in a SQL query. This function converts null to NULL, boolean to 0 or 1, and a string is surrounded by quotes unless the second param is false.
	 *
	 * @param string $string
	 * @param bool $quotes Add quotes to the string
	 * @param bool $percentages Also escape % (only to be used in WHERE LIKE)
	 * @return string
	 */
	public function escapeForSql($string, $quotes = true, $percentages = false)
	{
		// make sure there is a database connection
		$this->connect();

		if ($string === null)
		{
			$string = 'NULL';
		}
		elseif (is_bool($string))
		{
			$string = $string ? 1 : 0;
		}
		elseif (!is_numeric($string) || strlen($string) != strlen( (int) $string) )
		{
			$string = $this->linkID->real_escape_string($string);
			if ($percentages)
				$string = str_replace("%", "\%", $string);
			if ($quotes)
				$string = '"' . $string . '"';
		}

		return $string;
	}

	/**
	 * Insert a single row in a table
	 *
	 * @param string $table
	 * @param mixed $object
	 * @return bool
	 */
	public function insert($table, $object)
	{
		// Validate table as a valid (not empty) string
		if (!Validator::isString($table))
			return false;

		if (Validator::isObject($object))
		{
			if (method_exists($object, '__beforeDBSave'))
				$object->__beforeDBSave();
			elseif (method_exists($object, '__cleanup'))
				$object->__cleanup();
			$data = get_object_vars($object);
		}
		else
			$data = $object;

		// Validate data as a valid (not empty) array
		if (!Validator::isArray($data, false))
			return false;

		// If table is comma separated (multiple tables), select only the first
		// and encapsulate it in backticks
		$exploded = explode(",", $table);
		$table = "`".reset($exploded)."`";

		// Initialize keys and values
		$keys	= array();
		$values	= array();

		// Loop trough the data and format the keys (columns) and values (fields)
		foreach($data as $key => $value)
		{
			if (!is_array($value) &&  !is_object($value))
		  	{
		  		$value = $this->escapeForSql($value);

				$keys[]		= "`".str_replace(".", "`.`", $key)."`";
				$values[]	= $value;
		  	}
		}

		// Make comma separated values from both keys and values
		$keys	= implode(", ", $keys);
		$values	= implode(", ", $values);

		// Make the query
		$query = "INSERT INTO $table ($keys) VALUES($values)";

		// Execute the query and return the result
		if ($this->execute($query))
		{
			if (Validator::isObject($object) && method_exists($object, '__afterDBSave'))
				$object->__afterDBSave();

			$insertID = $this->insertID();
			if ($insertID === 0) // No insert ID available (no autoincrement columns)
				return true;
			else
				return $insertID;
		}
		else
			return false;
	}


	/**
	 * Deletes rows from one or more tables
	 *
	 * @param mixed $tables
	 * @param string $where
	 * @return int affected rows
	 */
	public function delete($tables, $where)
	{
		$this->connect();

		if (!Validator::isString($where))
			return false;

		if (!Validator::isArray($tables))
			$tables = array($tables);

		if (!Validator::isArray($tables, false))
			return false;

		$affected = 0;

		foreach($tables as $table){
			$query = "DELETE FROM `$table` WHERE $where";
			if ($this->execute($query))
				$affected += $this->affectedRows();
		}

		return $affected;
	}

	/**
	 * Return the number of rows affected by a query
	 * after UPDATE, INSERT, REPLACE or DELETE queries
	 *
	 * @return int
	 */
	public function affectedRows()
	{
		return mysqli_affected_rows($this->linkID);
	}

	/**
	 * Escape a string to be used in a SQL query. This function converts null to NULL, boolean to 0 or 1, and a string is surrounded by quotes unless the second param is false.
	 *
	 * @param string $string
	 * @param bool $quotes Add quotes to the string
	 * @param bool $percentages Also escape % (only to be used in WHERE LIKE)
	 * @return string
	 */
	public static function escapeStaticForSql($string, $quotes = true, $percentages = false)
	{
		// make sure there is a database connection
		$db = DB::loadDb();
		$db->connect();

		if ($string === null)
		{
			$string = 'NULL';
		}
		elseif (is_bool($string))
		{
			$string = $string ? 1 : 0;
		}
		elseif (!is_numeric($string) || strlen($string) != strlen( (int) $string) )
		{
			$string = $db->escapeForSql($string, $quotes, $percentages);
			if ($percentages)
				$string = str_replace("%", "\%", $string);
			if ($quotes)
				$string = '"' . $string . '"';
		}

		return $string;
	}





}