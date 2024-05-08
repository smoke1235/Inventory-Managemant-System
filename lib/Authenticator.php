<?php

/**
 * Static class to perform authenticating functions
 *
 * @author Peter Donders
 * @version 1.8.7
 *
 * Changelog
 * 1.8.7
 * 		Changed hasModuleRights: now casts module names to lower case
 * 1.8.6
 * 		Changed retrievePassword: no longer uses removed / never made function from Users module
 * 1.8.5
 * 		Changed logout method: now also resets rights and moduleRights cache
 * 1.8.4
 * 		Fixed faulty grouprights check
 * 1.8.3
 * 		Replaced all calls to deprecated cms->moduleExists to cms->modules->exists
 * 1.8.2
 * 		Changed checkHash method: now handles short password hashes as 'probably md5'
 * 1.8.1
 * 		Changed login method: improved loginattempts
 * 1.8.0
 * 		Fixed references to incorrect database for multiDB sites (getEmail and password-related functions)
 * 		Changed login method: now uses IpBan 1.1.0 implementation
 * 		Changed encodePassword function to support custom mixed sha256 encoding instead of md5
 * 		Added checkHash function to validate a password against the current encodePassword's result
 * 1.7.0
 * 		Changed login method: now uses IpBan class to implement IP banning
 * 		Changed login method: now sleeps after unsuccesfull logins
 * 		Class now uses Cms Core DB
 * 1.6.3
 * 		Added checks wether the users module exists to prevent notices
 * 1.6.2
 * 		Added hasRightsOnSiteIDs function for beheer/index.php to redirect ot a different siteID if the current user has no rights
 * 1.6.1
 * 		Bugfix on isLoggedIn method: getData call parameters was not an array
 * 1.6.0
 * 		Changed login method: now saves login attempts, replaced frontend parameter with url
 * 		Changed processLogin method: now parses redirecturl to login call
 * 		Removed saveLoginAttempt method
 * 1.5.1
 *		Lowered deprecated messages errorlevel from error to notice
 * 1.5.0
 *		Added copyRights method
 * 1.4.3
 *		Changed processLostPass method: added redirect
 * 1.4.2
 * 		Replaced trigger_error calls with Errors::addError
 *		Replaced eregi calls with preg_match
 * 1.4.1
 * 		Changed loadRights method: added extra isset check to avoid notices
 *		Changed hasModuleRights method: developers automatically get all rights
 *		Changed hasSiteRights method: developers automatically get all rights
 *		Replaced calls to urldecode and urlencode in database communication to Strings::escapeForSql
 *		Removed extra quotes when using Strings::escapeForSql
 * 1.4.0
 *		Added isDeveloper cache attribute
 *		Added isLoggedIn cache attribute
 *		Added getUsername cache attribute
 *		Added getEmail cache attribute
 *		Changed getUsername method: cache
 *		Changed getEmail method: cache
 *		Changed processLogin method: save user data on login, logout on error
 *		Changed logout method: check if user is logged in
 *		Changed isLoggedIn method: cache
 *		Changed isDeveloper method: cache
 * 1.3.0
 * 		Added hasSiteRights method
 * 		Changed processLogin method: added urldecode to redirect post value
 * 1.2.1
 * 		Changed hasAccess method: developers automatically get all rights
 *		Changed loadRights method: reset self::$rights before refreshing rights
 *		Changed loadModuleRights method: added extra isset check to avoid notices
 *		Changed processLogin method: added redirectUrl in post (default to Cms::$httpPath)
 *		Replaced E_WARNING triggers by E_USER_WARNING
 * 1.2.0
 * 		Added getEmail method
 * 		Added checkLostpassCode method
 * 		Added setCodeAsUsed method
 * 		Added deleteRetrievePass method
 * 		Added encodePassword method
 * 		Changed processLostpass method: rewrote mail functionality
 * 		Merged getUsername and getUsernameByID methods into getUsername
 * 		Deprecated getUsernameByID method
 * 		Deprecated getEmailByID method
 * 		Replaced calls to cms->siteID to cms->getSiteID()
 * 		Prefixed the tables used with 'core_'
 * 1.0.2
 * 		Changed loadModuleRights method: bugfix
 * 1.0.1
 * 		Changed hasAccess method: first check on '__ALL__', then on siteID
 * 1.0.0
 * 		First version
 */
class Authenticator
{
	const LOSTPASS_TOO_MANY_ATTEMPTS = -1;
	const LOSTPASS_SAVE_ERROR = -2;

	private static $rights;

	private static $isDeveloper;
	private static $isLoggedIn;
	private static $getUsername;
	private static $getEmail;

	/**
	 * Private constructor to force this class to be static
	 *
	 */
	private function __construct() { }

	/**
	 * Check if the currently logged in user has specified access
	 *
	 * @param int $siteID
	 * @param string $moduleName
	 * @param string $right
	 * @return bool
	 * @todo Ik verwacht dat het controleren op rechten niet goed gaat als er zowel een ALL als een specifieke site of module in de rechtenarray aanwezig is. De vraag is waar dit opgelost moet worden: in de controle of in het creeren van de array.
	 */
	public static function hasAccess($siteID, $moduleName, $right)
	{
		$moduleName = ($moduleName != 'CORE' ? strtolower($moduleName) : $moduleName);
		$siteID = (string) $siteID;

		if(self::isDeveloper())
			return true;

		// check for correct vars
		if(!Validator::isString($siteID) || !Validator::isString($moduleName) || !Validator::isString($right))
			return false;

		// Check if this user had access to this site and/or module
		if(!self::hasModuleRights($siteID, $moduleName))
			return false;

		// load rights
		self::loadRights($siteID);

		@$siteRights = self::$rights['__ALL__']
			OR @$siteRights = self::$rights[$siteID]
			OR $siteRights = false;
		if (!$siteRights)
			return false;

		@$moduleRights = $siteRights['__ALL__']
			OR @$moduleRights = $siteRights[$moduleName]
			OR $moduleRights = false;
		if (!$moduleRights)
			return false;

		@$specificRight = $moduleRights['__ALL__']
			OR @$specificRight = $moduleRights[$right]
			OR $specificRight = false;

		return $specificRight;
	}

	/**
	 * Load user rights for a specific site
	 *
	 * @param int $siteID
	 */
	private static function loadRights($siteID)
	{
		if (isset(self::$rights) && isset(self::$rights[$siteID]))
			return;

		$userID = self::getUserID();

		// Load all rights for this site
		$query = "
			SELECT * FROM `".TABLE_PREFIX."core_right`
			WHERE
				`userID` = $userID AND
				(`siteID` = '" . $siteID . "' OR `siteID` = '__ALL__')
			";

		$rights = Cms::DB(true)->selectRows($query);

		self::$rights = array();
		foreach ($rights as $right)
		{
			// store this right in $rights array for future use
			self::$rights[$right['siteID']][$right['module']][$right['right']] = true;
		}

		// If user module exists, get group rights if available
		$cms = Cms::loadCms();
		$grouprights = $cms->getData('users', 'getGrouprightsByUserID', array($userID, $siteID));
		if ($grouprights)
			self::$rights = Arrays::fuse(self::$rights, $grouprights);
	}

	/**
	 * Public function to load all rights from a specific siteID for the current user
	 *
	 * @param int $siteID
	 * @return Array
	 */
	public static function getRights($siteID)
	{
		if(!Validator::isArray(self::$rights[$siteID]))
			self::loadRights($siteID);

		return self::$rights[$siteID];

	}

	/**
	 * Load moduleright per site
	 *
	 * @return void
	 *
	 */
	private static function loadModuleRights()
	{
		if(self::$moduleRights)
			return;

		$userID = self::getUserID();

		$sql = "SELECT DISTINCT `siteID`, `module` FROM `".TABLE_PREFIX."core_right` WHERE userID = " . $userID;
		$rows = Cms::DB(true)->selectRows($sql);

		// compose array of rights
		$_moduleRights = array();
		foreach ($rows as $row)
			$_moduleRights[$row['siteID']][] = $row['module'];

		// If user module exists, get group module rights and add them to the $_moduleRights Array.
		$cms = Cms::loadCms();
		$groupmodulerights = $cms->getData('users', 'getGroupModulerightsByUserID', array($userID));
		if (Validator::isArray($groupmodulerights, false))
			foreach($groupmodulerights as $siteID => $modules)
				foreach($modules as $module)
					if(!isset($_moduleRights[$siteID]) || !in_array($module, $_moduleRights[$siteID]))
						$_moduleRights[$siteID][] = $module;

		self::$moduleRights = $_moduleRights;
	}

	/**
	 * Check if user has module rights
	 *
	 * @param int $siteID Current site ID for which rights should be checked
	 * @param string $moduleName Name of the module to be checked
	 * @return bool
	 */
	public static function hasModuleRights($siteID, $moduleName)
	{
		if(self::isDeveloper())
			return true;

		// check if module rights have been loaded, if not do it now
		self::loadModuleRights();

		if(isset(self::$moduleRights['__ALL__']))
			 $moduleRightsForSite = self::$moduleRights['__ALL__'];
		elseif(isset(self::$moduleRights[$siteID]))
			$moduleRightsForSite = self::$moduleRights[$siteID];
		else
			return false;

		$moduleName = ($moduleName != 'CORE' ? strtolower($moduleName) : $moduleName);
		if(!in_array($moduleName, $moduleRightsForSite) && !in_array('__ALL__', $moduleRightsForSite))
			return false;

		return true;
	}

	/**
	 * Check if user has access to a site
	 *
	 * @since 1.3.0
	 * @param int $siteID Current site ID for which rights should be checked
	 * @return bool
	 */
	public static function hasSiteRights($siteID)
	{
		if(self::isDeveloper())
			return true;

		// check if module rights have been loaded, if not do it now
		self::loadModuleRights();

		if(isset(self::$moduleRights['__ALL__']))
			 $moduleRightsForSite = self::$moduleRights['__ALL__'];
		elseif(isset(self::$moduleRights[$siteID]))
			$moduleRightsForSite = self::$moduleRights[$siteID];
		else
			return false;

		if(!Validator::isArray($moduleRightsForSite, false))
			return false;

		return true;
	}

	/**
	 * Retrieve an array of all siteID's current user has rights for, or true if the user is developer
	 *
	 * @return array[int]|true array of siteIDs that the current user has any rights at all for, or true if the user is developer
	 */
	public static function hasRightsOnSiteIDs()
	{
		if(self::isDeveloper())
			return true;

		// check if module rights have been loaded, if not do it now
		self::loadModuleRights();

		if(Validator::isArray(self::$moduleRights, false))
			$moduleRights = self::$moduleRights;
		else
			return array();

		return array_keys($moduleRights);
	}

	/**
	 * Extract the user ID of the currently logged in user
	 *
	 * @return int User ID (0 if no user is logged in)
	 */
	public static function getUserID()
	{
		$userID = isset($_SESSION['loggedinuser']['userID']) ? $_SESSION['loggedinuser']['userID'] : 0;
		if(!Validator::isInt($userID))
			$userID = 0;

		return $userID;
	}

	/**
	 * Extract the username of the currently logged in user or a given user ID
	 *
	 * @param int $userID
	 * @return string|false username
	 */
	public static function getUsername($userID = false)
	{
		if($userID)
			$userID = (int) $userID;
		else
			$userID = self::getUserID();

		if(!isset(self::$getUsername[$userID]))
		{
			$cms = Cms::loadCms();
			$userName = $cms->getData('users', 'getUsernameByID', array($userID));
			if ($userName !== null)
				self::$getUsername[$userID] = $userName;
			else
			{
				$query = "SELECT `username` FROM `".TABLE_PREFIX."core_user` WHERE `id` = $userID";
				self::$getUsername[$userID] = $cms->coreDb->selectValue($query);
			}
		}

		return self::$getUsername[$userID];
	}

	/**
	 * Get the email address of the currently logged in user or a given user ID
	 *
	 * @since 1.2.0
	 * @author RobTiemens
	 * @param int $userID
	 * @return string|false
	 */
	public static function getEmail($userID = false)
	{
		if($userID)
			$userID = (int) $userID;
		else
			$userID = self::getUserID();

		if(!isset(self::$getEmail[$userID]))
		{
			$cms = Cms::loadCms();

			$query = "SELECT `email` FROM `".TABLE_PREFIX."core_user` WHERE `id` = $userID";
			self::$getEmail[$userID] = urldecode($cms->coreDb->selectValue($query));
		}

		return self::$getEmail[$userID];
	}

	/**
	 * Extract the username of the currently logged in user or a given user ID
	 *
	 * @deprecated
	 * @param int $userID
	 * @return string|false username
	 */
	public static function getUsernameByID($userID = false)
	{
		Errors::addNotice("Authenticator: getUsernameByID() is deprecated, use Authenticator::getUsername() instead");
		return self::getUsername($userID);
	}

	/**
	 * Get the email address of the currently logged in user or a given user ID
	 *
	 * @deprecated
	 * @param int $userID
	 * @return string|false
	 */
	public static function getEmailByID($userID = false)
	{
		Errors::addNotice("Authenticator: getEmailByID() is deprecated, use Authenticator::getEmail() instead");
		return self::getEmail($userID);
	}

	/**
	 * Perform login
	 *
	 * @param string $username Username filled out by user; doesn't have to be escaped in any way
	 * @param string $password Password filled out by user; should be non-hashed
	 * @param string $url Url on which a user tries to log in
	 * @return mixed User instance in case of succes or false in case of no succes
	 */
	public static function login($username, $password, $url = "")
	{
		// Left trim the password (remove trailing whitespaces)
		$password = rtrim($password);

		$cms = Cms::loadCms();
		$siteID = $cms->getSiteID();

		if( IpBan::isBanned('user') )
		{
			LoginAttempt::add($username, $url, 'user');
			Cms::DB(true)->insert(TABLE_PREFIX.'core_loginattempt', $attempt);

			return -1; // Parameters incorrect: username/password combo incorrect
		}
		else
		{
			$ipbanMaxAttempts = (int)$cms->getSettingValue('login_ipban_attempts' ,'CORE');
			$failedLoginAttempts = LoginAttempt::countAttempts($_SERVER['REMOTE_ADDR'], 'user' ,false);

			// Check for IP block
			if( Validator::isInt($ipbanMaxAttempts) && $ipbanMaxAttempts > 0 && $failedLoginAttempts >= $ipbanMaxAttempts )
			{
					IpBan::add('user', $_SERVER['REMOTE_ADDR'], time());
			}
		}

		if (!Validator::isString($username) || !Validator::isString($password))
		{
			LoginAttempt::add($username, $url, 'user');
			return false; // Parameters incorrect: username/password combo incorrect
		}

		//retrieve info for username
		$query = 'SELECT * FROM `'.TABLE_PREFIX.'core_user` WHERE `username` = '.Strings::escapeForSql($username).' LIMIT 1';

		$row = Cms::DB(true)->selectRow($query);
		if(!Validator::isArray($row, false))
		{
			LoginAttempt::add($username, $url, 'user');
			return false; // no username match found
		}

		//check stored password length: 32 for old style hashing, 128 for 2012 style
		$hashedPassword = $row['password'];
		if(strlen($hashedPassword) == 32)
		{
			if ($row && $username === $row['username'] && md5($password) === $hashedPassword)
			{
				$user = array('userID'=>$row['id'], 'userName'=>$username);

				LoginAttempt::add($username, $url, 'user', $row['id']);
				return $user; // Login successful: instance of user
			}

			LoginAttempt::add($username, $url, 'user');
			return false; // invalid password or SQL Hack detected
		}
		if(strlen($hashedPassword) == 128)
		{
			if ($row && $username === $row['username'] && Authenticator::checkHash($password, $hashedPassword) )
			{
				$user = array('userID'=>$row['id'], 'userName'=>$username);

				LoginAttempt::add($username, $url, 'user', $row['id']);
				return $user; // Login successful: instance of user
			}
			else
			{
				LoginAttempt::add($username, $url, 'user');
				return false; // SQL Hack detected
			}
		}
		LoginAttempt::add($username, $url, 'user');
		return false;
	}

	/**
	 *
	 * Function to check hashed password against entered password
	 * @param string $password
	 * @param string $hashedPassword
	 * @param int $mixStyle style to use for mixing salt, 0 for hash|salt|hash|salt|... , 1 for salt|hash|salt|hash|...
	 * @return bool successful comparison
	 */
	public static function checkHash($password, $hashedPassword, $mixStyle = 0)
	{
		if(strlen($hashedPassword) != 128)
			return (md5($password) == $hashedPassword);

		//split hashPassword in saltString and hashResult
		$hashResult = "";
		$saltString = "";
		for($i = 0; $i < 128; $i++)
		{
			if($i % 2 == 0) //even: part of the hashResult
				$hashResult .= $hashedPassword[$i];
			else //odd: part of the saltString -> reverse saltString
				$saltString = $hashedPassword[$i] . $saltString;
		}

		//insert password into salt string
		$saltedPassword = "";
		for($j = 0; $j < 64; $j++)
		{
			if(isset($password[$j]))
			{
				switch($mixStyle)
				{
					case 1:
						$saltedPassword .= $password[$j] . $saltString[$j];
					break;
					case 0:
					default:
						$saltedPassword .= $saltString[$j] . $password[$j];
					break;
				}
			}
			else
			{
				$saltedPassword .= substr($saltString, $j);
				break;
			}
		}

		$hash = hash("sha256", $saltedPassword);

		//hash salted password & compare to hashResult
		return (bool) ($hash == $hashResult);
	}

	/**
	 * Check the lostpassword code
	 *
	 * @since 1.2.0
	 * @param string $code
	 * @return int|false UserID on success, false on failure
	 */
	public static function checkLostpassCode($code)
	{
		if (!Validator::isString($code))
			return false; // Parameter incorrect: code incorrect

		// Check if code exists in the database
		$query = 'SELECT * FROM `'. TABLE_PREFIX .'core_retrievepasslog` WHERE `code` = ' . Strings::escapeForSql($code) . ' AND `used` = "0" AND `dateAdded` + INTERVAL 1 DAY > NOW();';

		$row = Cms::DB()->selectObject($query);

		if(isset($row->userID) && Validator::isInt($row->userID))
			return $row->userID;
		else
			return false;
	}

	/**
	 * Save the given code as "already used"
	 *
	 * @since 1.2.0
	 * @param string $code
	 * @return bool Success
	 */
	public static function setCodeAsUsed($code)
	{
		if (!Validator::isString($code))
			return false; // Parameter incorrect: code incorrect

		// Check if code exists in the database
		$query = 'UPDATE `'. TABLE_PREFIX .'core_retrievepasslog` SET `used` = "1" WHERE code` = ' . Strings::escapeForSql($code) . ';';

		$row = Cms::DB()->query($query);

		return true;
	}

	/**
	 * Log a user out
	 *
	 * @return bool
	 *
	 * @todo Also reset backend site id
	 */
	public static function logout()
	{
		$_SESSION['loggedinuser'] = array();
		unset($_SESSION['loggedinuser']);

		self::$rights = null;
		self::$moduleRights = null;
	}

	/**
	 * Check if there is a user logged in
	 *
	 * @return bool
	 *
	 * @todo Perhaps some extra checks?
	 */
	public static function isLoggedIn()
	{
		$userID = self::getUserID();

		if(!isset(self::$isLoggedIn[$userID])) // check for cached value
		{
			$cms = Cms::loadCms();

			if(Validator::isInt($userID) && $userID > 0 && (!$cms->modules->exists('users') || !$cms->getData('users', 'isSuspended', array($userID))) )
				self::$isLoggedIn[$userID] = true;
			else
				self::$isLoggedIn[$userID] = false;

		}

		return self::$isLoggedIn[$userID];
	}

	/**
	 * Check if the current user is a developer
	 *
	 * @return bool
	 */
	public static function isDeveloper()
	{
		if(!self::isLoggedIn())
			return false;

		$userID = (int) self::getUserID();
		if (!$userID)
			return false;

		if(!isset(self::$isDeveloper[$userID])) // check for cached value
		{
			$table = TABLE_PREFIX.'core_user';
			$query = "SELECT `developer` FROM `$table` WHERE `id` = $userID";
			$developer = Cms::DB(true)->selectValue($query);

			self::$isDeveloper[$userID] = ($developer === "1");
		}
		return self::$isDeveloper[$userID];
	}

	/**
	 * Retrieves the IP-adres of the current visitor
	 *
	 * @return string IP
	 */
	public static function getIP()
	{
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			$ips = explode (",", $_SERVER['HTTP_X_FORWARDED_FOR']);
			$totalIPs = count($ips);
			for ($i = 0; $i < $totalIPs; $i++)
			{
				$ips = trim($ips[$i]);
				//if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i]))
				if (!preg_match('/^(10|172\.16|192\.168)\./i', $ips[$i]))
				{
						$ip = $ips[$i];
						break;
				}
			}
		}
		elseif (!empty($_SERVER['HTTP_VIA']))
		{
			$ips = explode (",", $_SERVER['HTTP_VIA']);
			$totalIPs = count($ips);
			for ($i = 0; $i < $totalIPs; $i++)
			{
				$ips = trim($ips[$i]);
				//if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i]))
				if (!preg_match('/^(10|172\.16|192\.168)\./i', $ips[$i]))
				{
						$ip = $ips[$i];
						break;
				}
			}
		}
		elseif(!empty($_SERVER['REMOTE_ADDR']))
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		else
		{
			$ip = "0.0.0.0";
		}
		return $ip;
	}

	/**
	 * Gets password from the database
	 *
	 * @param string $username Username filled out; should be not escaped
	 * @param string $email E-mail address filled out; should be not escaped
	 * @param int $maxAttempts Counter of the attempts made based on userID
	 * @return bool
	 */
	public static function retrievePassword($username, $email, $maxAttempts = 20)
	{
		if (!Validator::isString($username) || !Validator::isString($email))
			return false; // Parameters incorrect: retrievePassword failed

		if( !Validator::isInt($maxAttempts))
			$maxAttempts = 20;

		$cms = Cms::loadCms();
		$userID = null;

		$query ='SELECT `u`.`id` FROM `'. TABLE_PREFIX .'core_user` `u` WHERE `u`.`username` = '.Strings::escapeForSql($username).' AND `u`.`email` = '.Strings::escapeForSql($email).' LIMIT 0,1';
		$userID = $cms->coreDb->selectValue($query);

		if ($userID > 0)
		{
			if (self::countRetrievePassAttempts($userID) >= $maxAttempts )
				return self::LOSTPASS_TOO_MANY_ATTEMPTS; // Too many attempts

			$code = md5(time());
			if (self::saveRetrievePass($userID, $code, false))
				return $code; // Return code
			else
				return self::LOSTPASS_SAVE_ERROR; // Save retrievepasslog failed
		}
		else
			return false; // No user found: retrievePassword failed
	}

	/**
	 * Counts number of unused attempts
	 *
	 * @param int $userID ID of a user
	 * @param int $hours Hours to check for attempts
	 * @return mixed On succes number of attempts will be returned, on failure false will be returned
	 */
	private static function countRetrievePassAttempts($userID, $hours = 24)
	{
		if( !Validator::isInt($userID))
			return false;

		if( !Validator::isInt($hours))
			$hours = 24;

		$since = strtotime('-'.$hours.' hours');
		$query = 'SELECT `id` FROM `'. TABLE_PREFIX .'core_retrievepasslog` WHERE `userID` = '.$userID.' AND `dateadded` >= FROM_UNIXTIME('.$since.')';

		if (Cms::DB()->query($query))
			return Cms::DB()->numRows();
		else
			return false;

	}

	/**
	 * Saves a retrievepass attempt in de database
	 *
	 * @param int $userID ID of a user
	 * @param string $code Generated random code to be saved
	 * @param bool $used Flag to mark a code as used
	 * @return bool
	 */
	private static function saveRetrievePass($userID, $code, $used)
	{
		if(!Validator::isInt($userID) || !Validator::isString($code) || !Validator::isBool($used))
			return false;

		$queryVars = ''; $queryValues = '';
		$queryVars .= '`code`, ';		$queryValues .= ''.Strings::escapeForSql($code).	', ';
		$queryVars .= '`used`, ';		$queryValues .= '"'.($used?'1':'0').	'", ';
		$queryVars .= '`userID`, ';	$queryValues .= '"'.$userID.			'", ';

		$queryVars .= '`dateadded`';	$queryValues .= 'FROM_UNIXTIME('.time().')';

		$query = 'INSERT INTO `'. TABLE_PREFIX .'core_retrievepasslog` ('.$queryVars.') VALUES ('.$queryValues.');';

		if (Cms::DB()->query($query))
		{
			return true;
		}
		else
			return false;

	}

	/**
	 * Deletes a retrievepass attempt in de database
	 *
	 * @since 1.2.0
	 * @param string $code Generated random code to be deleted
	 * @return bool
	 */
	public static function deleteRetrievePass($code)
	{
		if(!Validator::isString($code))
			return false;

		$query = 'DELETE FROM `'. TABLE_PREFIX .'core_retrievepasslog` WHERE `code` = "' . $code . '";';

		if (Cms::DB()->query($query))
		{
			return true;
		}
		else
			return false;

	}

	/**
	 * Encodes a password for storage in the database
	 * Mix style 0 is used for core passwords, 1 is used for frontuser passwords
	 *
	 * @since 1.2.0
	 * @param string $password unencoded password
	 * @param int $mixStyle style to use for mixing salt, 0 for hash|salt|hash|salt|... , 1 for salt|hash|salt|hash|...
	 * @return string encoded password
	 */
	public static function encodePassword($password, $mixStyle = 0)
	{
		//generate random saltString
		$length = 64;
		$saltString = "";
		$mt = function_exists('mt_rand'); //use mt_rand if available for better random characters
		for($i = 0; $i < $length; $i++)
		{
			if($mt)
				$saltString.= dechex(mt_rand(0,15));
			else
				$saltString.= dechex(rand(0,15));
		}

		//Create reversed salt string for combining for storage
		$reverseSaltString = strrev($saltString);

		//insert password into salt string
		$saltedPassword = "";
		for($j = 0; $j < 64; $j++)
		{
			if(isset($password[$j]))
			{
				switch($mixStyle)
				{
					case 1:
						$saltedPassword .= $password[$j] . $saltString[$j];
					break;
					case 0:
					default:
						$saltedPassword .= $saltString[$j] . $password[$j];
					break;
				}

			}
			else
			{
				$saltedPassword .= substr($saltString, $j);
				break;
			}
		}

		//hash salted password
		$hashResult = hash("sha256", $saltedPassword);

		//combine hashPassword with reversed saltstring
		$encodedPassword = "";
		for($k = 0; $k < 64; $k++)
		{
			$encodedPassword .= $hashResult[$k] . $reverseSaltString[$k];
		}

		//return encoded password
		return $encodedPassword;

		//return md5($password);
	}

	/**
	 * Copy all rights from one site to another
	 *
	 * @since 1.5.0
	 * @param int $sourceSiteID
	 * @param int $targetSiteID
	 */
	public static function copyRights($sourceSiteID, $targetSiteID)
	{
		$sourceSiteID = (int) $sourceSiteID;
		$targetSiteID = (int) $targetSiteID;

		$data = Cms::DB(true)->selectRows('SELECT `userID`, '.$targetSiteID.' AS `siteID`, `module`, `right` FROM `'.TABLE_PREFIX.'core_right` WHERE `userID` = '.self::getUserID().' AND `siteID` = '.$sourceSiteID);
		Cms::DB(true)->insertRows(TABLE_PREFIX.'core_right', $data);
	}
}

?>