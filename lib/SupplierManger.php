<?php

/**
 * SupplierManger, handles suppliers
 *
 * @author Peter Donders
 * @version 0.0.2
 *
 * Changelog
 * 0.0.2
 * 		Added Delete method
 * 		Moved isEnum and isOrderDir method to own file
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

		if (Validator::isOrderDir($orderDir) && Validator::isEnum($orderBy, self::$allowedOrderBy))
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
    public function getSupplier(int $id) {

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
	 * Delete a given supplier
	 *
	 * @param int $id
	 * @return bool
	 */
	public function delete(int $id) {
		
		$id = (int) $id;
		if (!$id)
			return false;

		$db = DB::loadDb();
		return $db->delete($this->table, "`id` = $id");
	}
}