<?php
/**
 * CustomerManger, handles Customer
 *
 * @author Peter Donders
 * @version 0.0.1
 *
 * Changelog
 * 0.0.2
 * 		Moved isOrderDir and isEnum method to own file
 * 0.0.1
 *      First Version
 */
class CustomerManger {

    const VERSION = '0.0.1';

    protected $table = 'customers';

    protected static $allowedOrderBy		= array("last_name", "first_name", "email");
	protected static $allowedOrderDir		= array("ASC", "DESC");

    /**
	 * Get a list of Customer
	 *
     * @param string $orderBy
	 * @param string $orderDir
	 * @param int $offset
	 * @param int $count
	 * @return array[Supplier]|false
	 */
    public function getList($orderBy = "", $orderDir = "", $offset = 0, $count = 0) {

        $db = DB::loadDb();

        if (is_int($offset) && is_int($count) && $count > 0)
			$limit = "LIMIT $offset, $count";
		else
			$limit = "";

		if (Validator::isOrderDir($orderDir) && Validator::isEnum($orderBy, self::$allowedOrderBy))
			$order = "ORDER BY `$orderBy` $orderDir";
		else
			$order = "ORDER BY `last_name` DESC";

        $itemQuery = "SELECT * FROM `$this->table` `i` $order $limit;";
        return $db->selectObjects($itemQuery, 'Customer', 'id');
    }

    /**
	 * Load a supplier from the database
	 * using the ID.
	 *
	 * @param int $id
	 * @return Supplier
	 */
    public function getItem(int $id) {

        $id			= (int) $id;

        $db = DB::loadDb();
        $sql = "SELECT * FROM `$this->table` WHERE id = $id";
        return $db->selectObject($sql, "Customer");
    }


    /**
	 * Fill an item with post values
	 *
	 * @param Supplier $item
	 * @return Supplier filled item
	 */
	public function fillItem(&$item) {

        $item->first_name = $_POST['customerFirstName'];
        $item->last_name = $_POST['customerLastName'];
        $item->company_name = $_POST['customerCompanyName'];
        $item->number = $_POST['customerNumber'];
        $item->email = $_POST['customerEmail'];
        $item->street = $_POST['customerStreet'];
        $item->postcode = $_POST['customerPostcode'];
        $item->city = $_POST['customerCity'];
        $item->country = $_POST['customerCountry'];

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

        // Save the item
		if ($item->id)
			$db->update($this->table, $item, '`id` = '.$item->id);
		else
		{
			$item->id = $db->insert($this->table, $item);
		}

        return $item;
    }


}