<?php



class ProductManger {

    const VERSION = '0.0.1';

    protected $table = 'products';

    protected static $productAllowedOrderBy						= array("id", "product_name", "price");
	protected static $productAllowedOrderDir					= array("ASC", "DESC");
	


    /**
	 * Constructor setting the params.
	 *
	 */
	public function __construct(private object $params) { }

    /**
	 * Function to get a list of product objects for a given categoryID,
	 * for both front and administrative purposes.
	 *
	 * @param int $categoryID
	 * @param string $orderBy
	 * @param string $orderDir
	 * @param int $limit
	 * @param int $page
	 * @param array[int] $ignoreProductIDs array of productIDs to be ignored.
	 * @param bool $admin
	 * @return array[Product]
	 */
	public function getProductList($orderBy = false, $orderDir = false, $limit = 0, $page = 1, $ignoreProductIDs = array())
	{
        // Ordering parameters.
		$orderBy		= (in_array($orderBy, self::$productAllowedOrderBy)) ? $orderBy : reset(self::$productAllowedOrderBy);
		$orderDir		= (in_array($orderDir, self::$productAllowedOrderDir)) ? $orderDir : reset(self::$productAllowedOrderDir);

		$ignores 		= "";
		$orderString	= "";
		$limitString	= "";

		// Prepare order by string.
		if(strlen($orderBy) && strlen($orderDir))
			$orderString = "ORDER BY `".$orderBy."` ".$orderDir;

		// Prepare limit string.
		if($limit)
			$limitString = " LIMIT ".($limit * ($page-1)).",".$limit;

		if(Validator::isArray($ignoreProductIDs, false))
		{
			$ignores = "WHERE `p`.`id` NOT IN (" . implode(",", $ignoreProductIDs) . ") ";
		}

		$db = DB::loadDb();
       
        $productListQuery = "
				SELECT `p`.*
				FROM `".$this->table."` `p`
				$ignores
				$orderString
				$limitString";

        // Fetch entire productlist.
		$productList = $db->selectObjects($productListQuery, "Product", 'id');

		return $productList;



    }
    /**
	 * Load a product from the database
	 * using the ID.
	 *
	 * @param int $id
	 * @return Product
	 */
    public function getItem($id) {

        $id = (int) $id;

        $db = DB::loadDb();
        
        $sql = "SELECT * FROM `$this->table` WHERE id = '$id'";
        
        return $db->selectObject($sql, "Product");
        
    }

    /**
	 * Fills a catalog product object with data from the edit form.
	 *
	 * @param Product &$product
	 * @return Product $product
	 */
	public function fillProduct(Product $product) {
      
		
		// General Tab.
		$product->product_name = $this->params->get('name', "");
		$product->product_description = $this->params->get('description', "");
		$product->other_details	= $this->params->get('other_details', "");
		$product->min_stock	= $this->params->get('min_stock', 0);
		
        // Fill the product object with information from the form.
		$product->product_price				= $this->params->get('price', "0");
        $product->product_quantity = $this->params->get('amount', 1);
        $product->supplier_id =  $this->params->get('supplier', 0);
		
        return $product;
    }


    private function getValidateLanguage() {

        $lang['product_validate']							= array();
        $lang['product_validate']['productCode']			= "Er is geen geldige productcode opgegeven.";
        $lang['product_validate']['taxgroup']				= "Er is geen geldige belastinggroep geselecteerd.";
        $lang['product_validate']['product_price']					= "Er is geen geldige prijs opgegeven, geef een geheel getal op of gebruik een punt of komma.";
        $lang['product_validate']['categories']				= "U dient minimaal een productcategorie te selecteren.";
        $lang['product_validate']['active']					= "Er is geen geldige optie gekozen bij actief.";
        $lang['product_validate']['omnipresent']			= "Er is geen geldige optie gekozen bij omnipresent.";
        $lang['product_validate']['producttype']			= "Er is geen geldige productsoort geselecteerd.";
        $lang['product_validate']['product_name']					= "U heeft geen geldige naam opgegeven.";
	    $lang['product_validate']['product_description']				= "U heeft geen geldige omschrijving opgegeven.";
        $lang['product_validate']['other_details']	= "U heeft geen geldige uitgebreide omschrijving opgegeven.";
	
        return $lang['product_validate'];
    }



    /**
	 * Saves a given product object.
	 *
	 * @param Product &$product
	 * @return array[boolean] $success
	 */
	public function saveProduct(&$product)
	{
		
		// Validate the productcategory object.
		$success 	= array();
		$boolean 	= array("0", "1");
		$validation	= $this->getValidateLanguage();

		$productExists = (bool) ($product->id > 0);

		// Validate product_name.
		if(!Validator::isString($product->product_name, 1))
		{
			$success["product_name"] = $validation["product_name"];
		}

		// Validate product_description.
		if(!Validator::isString($product->product_description, 0))
		{
			$success["product_description"]	= $validation["product_description"];
		}

		// Validate other_details.
		if(!Validator::isString($product->other_details, 0))
		{
			$success["other_details"]	= $validation["other_details"];
		}

        
		
        // Fix price to cents.
		$product->product_price 					= WebshopObject::convertPriceToCents($product->product_price);

		// Validate price.
		if(!(Validator::isFloat($product->product_price) || Validator::isInt($product->product_price)))
		{
			$success['product_price']				= $validation["product_price"];
		}

       // Validate supplier
		if(! Validator::isInt($product->supplier_id))
		{
			$success['supplier_id']				= $validation["supplier_id"];
		}

		// Set date modified and user modified.
		$product->date = time();
		
        $db = DB::loadDb();

        // Store the product.
		// If object has an identifier, we're editing a product.
		if ($productExists)
		{
			// Execute the update query of productcategory.
			$db->update($this->table, $product, '`id` = '.$product->id);
		}
		// If object has no identifier, we're inserting a new product.
		else
		{
			// Execute the insert query of product.
			$product->id = $db->insert($this->table, $product);
		}

		return $success;
	}

    /**
	 * Function to permanently delete a product.
	 *
	 * @param int $id
	 * @return bool
	 */
	public function delete($id)
	{
		if (!$id)
			return false;

        $db = DB::loadDb();

		return $db->delete($this->table, "`id` = $id");
	}



	/**
	 * Search for products matching a given pattern. Pattern matches are checked on name and producttype.
	 *
	 * @param string $pattern
	 * @param bool $admin
	 * @return Array[Product]
	 */
	public function searchProducts($pattern)
	{
		$db = DB::loadDb();

		$productSearchQuery = "
			SELECT *
			FROM `".$this->table."`
			WHERE (LOWER(`product_name`) LIKE LOWER('%$pattern%') OR `id` LIKE '%$pattern%')
			LIMIT 0, 30";

		$productSearch = $db->selectObjects($productSearchQuery, "Product");
		
		return $productSearch;
	}

}