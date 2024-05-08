<?php

/**
 * Class WebshopObject used as a parent class for products to use them as objects for a CartItem.
 *
 * @author Peter Donders
 */
abstract class WebshopObject
{
	const OBJECTTYPE_PRODUCT 					= 0;
	const OBJECTTYPE_DISCOUNT					= 1;
	const OBJECTTYPE_PAYMENTMETHOD				= 2;
	const OBJECTTYPE_SHIPPINGMETHOD				= 3;

	protected $options;

	/**
	 * The object' type, value by one of the consts.
	 */
	protected $objectType = self::OBJECTTYPE_PRODUCT;

	/**
	 * The object's representing amount.
	 */
	protected int $amount = 1;

	/**
	 * An optional object's parent.
	 */
	protected $parent = null;

	/**
	 * Constructor setting the type.
	 *
	 * @param int $objectType
	 */
	public function __construct($objectType = self::OBJECTTYPE_PRODUCT)
	{
		$this->setObjectType($objectType);
	}

	/**
	 * Function to get the ID of the webshop object.
	 *
	 * @return int $id
	 */
	public function getID()
	{
		if(isset($this->id))
			return $this->id;

		return false;
	}

	/**
	 * Function to set the objecttype.
	 *
	 * @param int $objectType
	 */
	public function setObjectType($objectType)
	{
		$this->objectType = (int) $objectType;
	}

	/**
	 * Function to get the objecttype.
	 *
	 * @return int $objectType
	 */
	public function getObjectType()
	{
		return $this->objectType;
	}

	/**
	 * Get the objecttype of the parent of this object
	 *
	 * @return int objecttype
	 */
	public function getParentType()
	{
		if ($this->parent)
			return $this->parent->getObjectType();
		return null;
	}

	/**
	 * Get public function for amount variable.
	 *
	 * @return (int) $amount;
	 */
	public function getAmount()
	{
		return $this->amount;
	}

	/**
	 * Set public function for amount variable.
	 *
	 * @param int $amount
	 */
	public function setAmount($amount)
	{
		$this->amount = (int) $amount;
	}

	/**
	 * Get the tax factor
	 *
	 * @return float
	 */
	public function getTaxFactor()
	{
		return ($this->getTaxPercentage() / 100) + 1;
	}

	/**
	 * Get the percentage of the current tax group
	 *
	 * @return int
	 */
	public function getTaxPercentage()
	{
		if (isset($this->taxgroup))
			return $this->taxgroup->percentage;
		elseif (isset($this->taxPercentage))
			return $this->taxPercentage;
		return 0;
	}

	/**
	 * Get the name of the current tax group
	 *
	 * @return string
	 */
	public function getTaxName()
	{
		if (isset($this->taxgroup))
			return $this->taxgroup->getTitle();
		elseif (isset($this->taxgroupName))
			return $this->taxgroupName;
		return "";
	}

	/**
	 * Set the price
	 *
	 * @param int $price
	 */
	public function setPrice($price)
	{
		$this->price = (int) $price;
	}

	/**
	 * Get the current price
	 *
	 * @param bool $formatted Return as float in currency (true) or as int in cents (false)
	 * @return int|float
	 */
	public function getPrice($formatted = false)
	{
		
		if ($formatted)
			return self::convertCentsToPrice($this->product_price);
		return $this->product_price;
	}

	/**
	 * Get the total price
	 *
	 * @param bool $formatted Return as float in currency (true) or as int in cents (false)
	 * @return int|float
	 */
	public function getTotalPrice($formatted = false)
	{
		if ($formatted)
			return self::convertCentsToPrice($this->product_price * $this->quantity);
		return ($this->product_price * $this->quantity);
	}

	/**
	 * Check if the product has a discount
	 *
	 * return bool
	 */
	public function hasDiscount()
	{
		if (isset($this->discount) && $this->discount && $this->discount->id)
			return $this->discount->appliesToProductAndAmount($this, $this->amount);
	}

	/**
	 * Get the discount price
	 *
	 * @param bool $formatted when true, the price will be formatted to a float
	 * @return int|float
	 */
	public function getDiscountPrice($formatted = false)
	{
		$price = $this->getPrice();

		if ($this->hasDiscount())
		{
			if ($this->discount->actionPercentage)
				$price *= 1-($this->discount->actionPercentage/100);
			elseif ($this->discount->actionValue)
				$price -= $this->discount->actionValue;
		}

		if ($price < 0)
			$price = 0;

		if ($formatted)
			return Numbers::convertCentsToPrice($price);

		return $price;
	}

	/**
	 * Get public function for parent variable.
	 *
	 * @return WebshopObject $parent
	 */
	public function getParent()
	{
		return $this->parent;
	}

	/**
	 * Set public function for parent variable.
	 *
	 * @param WebshopObject $parent
	 */
	public function setParent(WebshopObject $parent)
	{
		$this->parent = $parent;
	}

	/**
	 * Function to compare a WebshopObject with one another.
	 * Two webshop objects are equals if type and itemID are equal.
	 *
	 * @param WebshopObject $object
	 * @return bool
	 */
	public function equals(WebshopObject $object)
	{
        
        // Not equal if class differs.
		if( $object->getObjectType() != $this->getObjectType())
			return false;

		// Not equal if both id variables are set and they don't match.
		if( (isset($object->id) && isset($this->id)) && $object->id != $this->id)
			return false;

		// Not equal if both itemID variables are set and they don't match.
		if( (isset($object->itemID) && isset($this->itemID)) &&	$object->itemID != $this->itemID)
			return false;

		// Not equal parents don't match.
		if( $object->getParent() != $this->getParent())
			return false;

		// Not equal options don't match.
		if ( $object->options != $this->options )
			return false;

		return true;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Function to convert a 2-decimaled value based on a given amount of cents.
	 *
	 * @param int $cents Price in cents
	 * @param string $decimalChar Decimal character, default ','
	 * @param string $zeroChar Replacement for '00', for example '-', false for no replacement, default false
	 * @param string $thousandChar Thousand character, default ''
	 * @return string
	 */
    public static function convertCentsToPrice($cents, $decimalChar = ',', $zeroChar = false, $thousandChar = '')
    {
        $cents = (float) $cents / 100;

        $price = number_format($cents, 2, $decimalChar, $thousandChar);

        if ($zeroChar)
            $price = str_replace($decimalChar.'00', $decimalChar.$zeroChar, $price);

        return $price;
    }

	/**
	 * Function to convert the amount of cents based on a given 2-decimaled value string.
	 *
	 * @param float $value
	 * @return int
	 */
	public static function convertPriceToCents($value)
	{
		$cents = ((float) str_replace(",", ".", $value)) * 100;

		return (int) round($cents);
	}

}

?>