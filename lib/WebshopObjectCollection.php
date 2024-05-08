
<?php

/**
 * Class WebshopObjectCollection, contains functions and variables to maintain a collection of 
 * objects within the webshop of different types.
 * Used by Cart and Order.
 *
 * @author Peter Donders
 */

class WebshopObjectCollection
{
	/**
	 * Customer information.
	 */
	public $customer_id = 0;
	
	

	/**
	 * Shipping address information.
	 */
	public $shipping_name = "";
    public $shipping_company = "";
    public $shipping_street = "";
    public $shipping_postalcode = "";
    public $shipping_city = "";
    public $shipping_country = "";

    /**
	 * Payment address information.
	 */
	public $billing_name = "";
    public $billing_company = "";
    public $billing_street = "";
    public $billing_postalcode = "";
    public $billing_city = "";
    public $billing_country = "";

	// The array containing objects in the collection.
	private $webshopObjects = array();

	/**
	 * Constructor for WebshopObjectCollection.
	 */
	public function __construct() { }

	/**
	 * Function to get all objects.
	 *
	 * @return Array[WebshopObject]
	 */
	public function getItems()
	{
		return $this->webshopObjects;
	}

	/**
	 * Count the current amount of items
	 *
	 * @return int
	 */
	public function countItems()
	{
		return count($this->webshopObjects);
	}

	/**
	 * Function to get the first item out of a list of webshopobjects of a given type.
	 *
	 * @param int $type
	 * @return WebshopObject $object
	 */
	public function getFirstItemByType($type = WebshopObject::OBJECTTYPE_PRODUCT)
	{
		// Get items of given type.
		$itemList = $this->getItemsByType($type);

		// If empty, return false.
		if(!count($itemList))
			return false;

		// Return first in array.
		return reset($itemList);
	}

	/**
	 * Function to get the last item out of a list of webshopobjects of a given type.
	 *
	 * @param int $type
	 * @return WebshopObject $object
	 */
	public function getLastItemByType($type = WebshopObject::OBJECTTYPE_PRODUCT)
	{
		// Get items of given type.
		$itemList = $this->getItemsByType($type);

		// If empty, return false.
		if(!count($itemList))
			return false;

		// Return last in array.
		return array_pop($itemList);
	}

	/**
	 * Function to return a list of webshopobjects of a given type.
	 * Default returns products.
	 *
	 * @param int $type
	 * @return Array $itemList
	 */
	public function getItemsByType($type = WebshopObject::OBJECTTYPE_PRODUCT)
	{
		// Check type for existence.
		$type = (in_array($type, Classes::getClassConstants("WebshopObject", "OBJECTTYPE"))) ? $type : WebshopObject::OBJECTTYPE_PRODUCT;

		$itemList = array();

		// Loop items.
		foreach($this->getItems() as $index => $webshopObject)
		{
			// If type matches.
			if($webshopObject->getObjectType() == $type)
			{
				// Add to item list.
				$itemList[$index] = $webshopObject;
			}
		}

		return $itemList;
	}

	/**
	 * Function to return a list of ids of cartitems of a given type.
	 * Default returns product ids.
	 *
	 * @param int $type
	 * @return Array $itemList
	 */
	public function getItemIdsByType($type = WebshopObject::OBJECTTYPE_PRODUCT)
	{
		// Check type for existence.
		$type = (in_array($type, Classes::getClassConstants("WebshopObject", "OBJECTTYPE"))) ? $type : WebshopObject::OBJECTTYPE_PRODUCT;

		$ids = array();

		// Loop items.
		foreach($this->getItems() as $index => $webshopObject)
		{
			// If type matches.
			if($webshopObject->getObjectType() == $type)
			{
				// If webshopobject contains an id.
				if(isset($webshopObject->id))
				{
					// Add to id array.
					$ids[] = $webshopObject->id;
				}
			}
		}

		return $ids;
	}

	/**
	 * Function to get a webshopObject on a given index.
	 *
	 * @param int $index
	 * @return WebshopObject $object
	 */
	public function &getItem($index)
	{
		if (isset($this->webshopObjects[$index]))
			return $this->webshopObjects[$index];

		return false;
	}

	/**
	 * Function to set a cartitem on a given index.
	 *
	 * @param int $index
	 * @param WebshopObject $item
	 */
	public function setItem($index, WebshopObject $item)
	{
		$this->webshopObjects[$index] = $item;
	}

	/**
	 * Function to set all items.
	 *
	 * @param array[WebshopObject] $items
	 */
	public function setItems($items)
	{
		// Clear.
		$this->clear();

		// Loop given items.
		foreach($items as $item)
		{
			$this->addItem($item);
		}
	}

	/**
	 * Function to add an item to the collection.
	 *
	 * @param WebshopObject $item
	 * @return bool
	 */
	public function addItem(WebshopObject $item)
	{
		if(!($item instanceof WebshopObject)){
            return false;
        }
		
        

		// Loop webshop objects in the collection.
		foreach($this->getItems() as $key => $webshopObject)
		{
            // If item matches, only exception where this step has to be skipped are discounts.
			if( $webshopObject->equals($item) && $item->getObjectType() != WebshopObject::OBJECTTYPE_DISCOUNT)
			{
                
				// Sum amounts if webshopobject is a product.
				if( $item->getObjectType() == WebshopObject::OBJECTTYPE_PRODUCT)
					$webshopObject->setAmount($webshopObject->getAmount() + $item->getAmount());
				else
					$webshopObject->setAmount(1);

				// Save.
				$this->webshopObjects[$key] = $webshopObject;

				return true;
			}
		}
        
		// If no matching cartitem was found, just add it.
		$this->webshopObjects[] = $item;

		return true;
	}

	/**
	 * Function to remove an item from the collection.
	 *
	 * @param WebshopObject $item
	 * @return bool
	 */
	public function removeItem(WebshopObject $item)
	{
		if(!($item instanceof WebshopObject))
			return false;

		// Loop webshop objects in the collection.
		foreach($this->getItems() as $key => $webshopObject)
		{
			// If item matches.
			if( $webshopObject->equals($item))
			{
				// Remove item.
				$this->removeIndex($key);

				return true;
			}
		}

		return true;
	}

	/**
	 * Function to remove an item on a given index from the collection.
	 *
	 * @param int $index
	 * @return bool
	 */
	public function removeIndex($index)
	{
		if(!array_key_exists($index, $this->getItems()))
			return false;

		unset($this->webshopObjects[$index]);

		return true;
	}

	/**
	 * Function to clear the collection.
	 */
	public function clear()
	{
		$this->webshopObjects = array();
	}

	/**
	 * Function to get the total amount of items, meaning webshopobjects multiplied by their amount.
	 * Default gives the total item amount in the collection, if no type was given.
	 *
	 * @param int $type (optional).
	 * @return int $amount
	 */
	public function getItemAmount($type = null)
	{
		$amount = 0;

		// Loop items.
		foreach($this->getItems() as $key => $webshopObject)
		{
			// If type was null or type matches object's type.
			if(is_null($type) || $type == $webshopObject->getObjectType())
			{
				// Up amount by object's amount.
				$amount += $webshopObject->getAmount();
			}
		}

		return $amount;
	}

	/**
	 * Function to search the collection for an array of children for a given parent.
	 *
	 * @param WebshopObject $item
	 * @return Array[WebshopObject] $children
	 */
	public function getChildrenItemsByParentItem(WebshopObject $item)
	{
		$children = array();

		// Loop items.
		foreach($this->getItems() as $key => $webshopObject)
		{
			// If object has item as parent, add as child.
			if($webshopObject->parent->equals($item))
			{
				$children[] = $webshopObject;
			}
		}

		return $children;
	}

	/**
	 * Function to search the collection for a parent of a given child.
	 *
	 * @param WebshopObject $item
	 * @return WebshopObject $parent
	 */
	public function getParentItemByChildItem(WebshopObject $item)
	{
		// Loop items.
		foreach($this->getItems() as $key => $webshopObject)
		{
			// If object has item as parent, return parent.
			if($item->getParent()->equals($webshopObject))
			{
				return $webshopObject;
			}
		}

		return false;
	}

	/**
	 * Function to get the total price of the collection taxless.
	 *
	 * @param bool $skipShippingMethods
	 * @param bool $skipPaymentMethods
	 * @param bool $formatted
	 * @return int $price
	 */
	public function getSubTotalPrice($skipShippingMethods = false, $skipPaymentMethods = false, $formatted = false)
	{
		// Price integer.
		$price = 0;

		// Loop items.
		$items = $this->getItems();
		foreach($items as $key => $webshopObject)
		{
			if ($skipShippingMethods && $webshopObject->getObjectType() == WebshopObject::OBJECTTYPE_SHIPPINGMETHOD)
				continue;

			if ($skipPaymentMethods && $webshopObject->getObjectType() == WebshopObject::OBJECTTYPE_PAYMENTMETHOD)
				continue;

			$price += $webshopObject->getTotalPrice();
		}

		if ($formatted)
			return WebshopObject::convertCentsToPrice($price);
		return $price;
	}

	/**
	 * Get total prices per vat taxgroup
	 *
	 * @param bool $skipShippingMethods
	 * @param bool $skipPaymentMethods
	 * @param bool $formatted
	 * @return mixed Prices per vat
	 */
	public function getTotalPricesPerVAT($skipShippingMethods = false, $skipPaymentMethods = false, $formatted = false)
	{
		// Initialize lists.
		$prices = array();
		$discounts = 0;

		// Loop items.
		$items = $this->getItems();
		foreach($items as $webshopObject)
		{
			// Store complete cart discounts in a separate list for seperate processing
			if ($webshopObject->getObjectType() == WebshopObject::OBJECTTYPE_DISCOUNT &&
				isset($webshopObject->applicationID) && $webshopObject->applicationID == Discount::APPLICATION_ENTIRE)
			{
				$discounts += $webshopObject->getPrice();
				continue;
			}

			// Skip shipping methods if needed
			if ($skipShippingMethods && $webshopObject->getObjectType() == WebshopObject::OBJECTTYPE_SHIPPINGMETHOD)
				continue;

			// Skip payment methods if needed
			if ($skipPaymentMethods && $webshopObject->getObjectType() == WebshopObject::OBJECTTYPE_PAYMENTMETHOD)
				continue;

			// Generate an array key for the taxgroup
			$key = (int) round(($webshopObject->getTaxFactor()-1)*100);

			// Initialize taxgroup total if needed
			if (!isset($prices[$key]))
				$prices[$key] = 0;

			// Add total price to taxgroup total
			$prices[$key] += $webshopObject->getTotalPrice();
		}

		// Add (negative) prices of discounts to the total prices, devided over all taxgroups
		$totalPrice = array_sum($prices);
		foreach ($prices as $key => $price)
		{
			if ($totalPrice)
				$factor = $price / $totalPrice;
			else
				$factor = 0;
			$prices[$key] += ($discounts * $factor);
		}

		// Calculate total prices including and excluding VAT and the difference between them
		$totalPrices = array();
		foreach ($prices as $factor => $price)
		{
			if ($this->priceIncludesVAT())
			{
				$totalPrices[$factor]['incl'] = $price;
				$totalPrices[$factor]['excl'] = round($price / (($factor / 100)+1));
			}
			else
			{
				$totalPrices[$factor]['excl'] = $price;
				$totalPrices[$factor]['incl'] = round($price * (($factor / 100)+1));
			}
			$totalPrices[$factor]['diff'] = round($totalPrices[$factor]['incl'] - $totalPrices[$factor]['excl']);
		}

		// Format the prices if needed
		if ($formatted)
		{
			foreach ($totalPrices as $factor => $price)
			{
				$totalPrices[$factor]['incl'] = Numbers::convertCentsToPrice($price['incl']);
				$totalPrices[$factor]['excl'] = Numbers::convertCentsToPrice($price['excl']);
				$totalPrices[$factor]['diff'] = Numbers::convertCentsToPrice($price['diff']);
			}
		}

		return $totalPrices;
	}

	/**
	 * Function to get the total price of the collection taxless.
	 *
	 * @param bool $skipShippingMethods
	 * @param bool $skipPaymentMethods
	 * @param bool $formatted
	 * @return int $price
	 */
	public function getTotalPrice($skipShippingMethods = false, $skipPaymentMethods = false, $formatted = false)
	{
		$totalPrice = 0;
		$prices = $this->getTotalPricesPerVAT($skipShippingMethods, $skipPaymentMethods);

		foreach ($prices as $price)
			$totalPrice += $price['incl'];

		if ($formatted)
			return Numbers::convertCentsToPrice($totalPrice);
		return $totalPrice;
	}

	/**
	 * Check if the price includes VAT
	 * Override for Order
	 *
	 * @return bool
	 */
	public function priceIncludesVAT()
	{
		return self::getWebshop()->getSettingValue('prices_include_vat');
	}

	/**
	 * Check if the price excludes VAT
	 * Override for Order
	 *
	 * @return bool
	 */
	public function priceExcludesVAT()
	{
		return !$this->priceIncludesVAT();
	}

	public function getTotalWeight()
	{
		$products = $this->getItemsByType(WebshopObject::OBJECTTYPE_PRODUCT);
		$weight = 0;

		foreach ($products as $product)
			$weight += ($product->weight * $product->getAmount());

		return $weight;
	}
}
