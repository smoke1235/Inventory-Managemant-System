<?php

/**
 * Class OrderLine, representing an individual record in a salesorder.
 *
 * @author Peter Donders
 */
class OrderLine extends WebshopObject
{
	public $id = 0;

	public $orderID = 0;
	public $itemID = 0;

	public $code = "";
	public $product_name = "";
	public $product_description = "";
	public $options = "";

	public $taxgroupID = 0;
	public $taxgroupName = "";
	public $taxgroupPercentage = 0;

	public int $amount = 1;
	public $price = 0;
	

	public $parentOrderLineID = 0;

	/**
	 * Get public function for code variable.
	 *
	 * @return $code
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * Get public function for title variable.
	 *
	 * @return $title
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Get public function for description variable.
	 *
	 * @return $description
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Get the percentage of vat (tax)
	 *
	 * @return int
	 */
	public function getTaxPercentage()
	{
		return $this->taxgroupPercentage;
	}

	/**
	 * Get the selected options
	 * @return string
	 */
	public function getOptions()
	{
		return $this->options;
	}

	public function getPriceIncludingVAT($formatted = false)
	{
		if ($this->priceIncludesVAT)
			return $this->getPrice($formatted);

		$price = $this->getPrice();
		$price *= $this->getTaxFactor();
		if ($formatted)
			return Numbers::convertCentsToPrice($price);
		return $price;
	}

	public function getPriceExcludingVAT($formatted = false)
	{
		if (!$this->priceIncludesVAT)
			return $this->getPrice($formatted);

		$price = $this->getPrice();
		$price /= $this->getTaxFactor();
		if ($formatted)
			return Numbers::convertCentsToPrice($price);
		return $price;
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
}

?>