<?php

class Product extends WebshopObject {
    
    public $id = 0;
	public $product_name;
	public $product_description;
	public $product_quantity = 1;
	public $product_price = 0;
	public $other_details;
	public $min_stock = 0;
	public $supplier_id;
	public $date;


	public function isLowOnStock() {


		if ($this->product_quantity < $this->min_stock) {
			return true;
		}

		return false;
	}


}