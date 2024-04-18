<?php

require_once '../src/classes/Supplier.php';

/**
 * SupplierManger, handles suppliers
 *
 * @author Peter Donders
 * @version 0.0.1
 *
 * Changelog
 * 0.0.1
 *      First Version
 */
class SupplierManger {

    const VERSION = '0.0.1';

    protected $table = 'suppliers';

    protected static $allowedOrderBy		= array("dateTime", "name");
	protected static $allowedOrderDir		= array("ASC", "DESC");

    /**
	 * Get a list of suppliers
	 *
     * @param string $orderBy
	 * @param string $orderDir
	 * @param int $offset
	 * @param int $count
	 * @return array[Supplier]|false
	 */
    public function getSuppliers($orderBy = "", $orderDir = "", $offset = 0, $count = 0) {

        $db = DB::loadDb();

        if (is_int($offset) && is_int($count) && $count > 0)
			$limit = "LIMIT $offset, $count";
		else
			$limit = "";

		if (self::isOrderDir($orderDir) && self::isEnum($orderBy, self::$allowedOrderBy))
			$order = "ORDER BY `$orderBy` $orderDir";
		else
			$order = "ORDER BY `dateTime` DESC";


        $itemQuery = "SELECT * FROM `$this->table` `i` $order $limit;";
        return $db->selectObjects($itemQuery, 'Supplier', 'id');
    }

    /**
	 * Load a supplier from the database
	 * using the ID.
	 *
	 * @param int $id
	 * @return Supplier
	 */
    public function getSupplier($id) {

        $id			= (int) $id;

        $db = DB::loadDb();
        $sql = "SELECT * FROM `$this->table` WHERE id = $id";
        return $db->selectObject($sql, "Supplier");
    }


    /**
	 * Fill an item with post values
	 *
	 * @param Supplier $item
	 * @return Supplier filled item
	 */
	public function fillItem(&$item) {

        $item->name = $_POST['supplierName'];
        $item->number = $_POST['supplierNumber'];
        $item->email = $_POST['supplierEmail'];
        $item->street = $_POST['supplierStreet'];
        $item->postcode = $_POST['supplierPostcode'];
        $item->city = $_POST['supplierCity'];
        $item->country = $_POST['supplierCountry'];

        return $item;
    }

    /**
	 * Save a single item
	 *
	 * @param Supplier &$item
	 * @return Supplier
	 */
	public function save(&$item)
	{
        $db = DB::loadDb();

        $item->dateTime = date("Y-m-d H:i:s"); 


        // Save the item
		if ($item->id)
			$db->update($this->table, $item, '`id` = '.$item->id);
		else
		{
			$item->id = $db->insert($this->table, $item);
		}

        return $item;
    }


    /**
	 * Check if a variable is a valid MySQL ordering direction
	 * ("ASC" or "DESC")
     * 
	 * @todo Make own file for this
     * 
	 * @param mixed $orderDir
	 * @return bool
	 */
	public static function isOrderDir($orderDir)
	{
		if (is_string($orderDir))
		{
			$orderDir = strtoupper($orderDir);
			if ($orderDir === 'ASC' || $orderDir === 'DESC')
				return true;
		}
		return false;
	}

    /**
	 * Check if a variable is a valid enumeration
	 * Validates true if $enum is within the list $allowedValues
     * 
     * @todo Make own file for this
	 *
	 * @param mixed $enum
	 * @param mixed $allowedValues
	 * @return bool
	 */
	public static function isEnum($enum, $allowedValues)
	{
		if (strlen($enum) && is_array($allowedValues) && in_array($enum, $allowedValues))
			return true;
		else
			return false;
	}
}