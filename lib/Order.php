<?php

/**
 * Class Order - Representing an order.
 *
 * @author Peter Donders
 */

class Order extends WebshopObjectCollection 
{
    /**
	 * Const variables for general order statusses.
	 */
	const ORDERSTATUS_RECEIVED		= 0;
	const ORDERSTATUS_PROCESSING	= 1;
	const ORDERSTATUS_SENT			= 2;
	const ORDERSTATUS_READY			= 3;
	const ORDERSTATUS_DELIVERED		= 4;
	const ORDERSTATUS_PICKEDUP		= 5;
	const ORDERSTATUS_CANCELLED		= 6;

    /**
	 * Order's own autoincrement unique identifier.
	 */
	public $id = 0;

    public $status = self::ORDERSTATUS_RECEIVED;

    /**
	 * General management variables.
	 */
	public $created = 0;
	public $updated = 0;
	public $user_id = 0;

    

    /**
	 * General information of the order.
	 */
	
	
	

    /**
	 * Constructor for a sales order object.
	 */
	public function __construct()
	{

	}


    /**
	 * Function to get a label belonging to a given status.
	 *
	 * @param int $status
	 * @return string $statusLabel
	 */
	public function getOrderStatusLabel($status)
	{

        $orderStatusLang = array(
			0 => "NEW",
			1 => 'IN PROCESS',
			2 => 'SHIPPING',
			3 => 'DELIVERD',
			4 => 'CLOSED',
			5 => 'RETURNED',
			6 => "ARCHIEVED",
        );

		// Fetch status label.
		$statusLabel = $orderStatusLang[$status];

		// If not valid, return unknown status label.
		if(!strlen($statusLabel))
			$statusLabel = 'order status unknown';

		return $statusLabel;
	}


    public function setCustomer(Customer $customer) {
        
        $this->customerID = $customer->id;
        $this->customerFirstName = $customer->first_name;
        $this->customerLastName = $customer->last_name;
        $this->customerEmail = $customer->email;
        $this->customerTelephone = $customer->number;

        unset($this->number);
        unset($this->mail);

    }


    



   



}