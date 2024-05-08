<?php

/**
 * OrderManger, handles orders
 *
 * @author Peter Donders
 * @version 0.0.1
 *
 * Changelog
 * 0.0.1
 *      First Version
 */

class OrderManger {

    const VERSION = '0.0.1';


    protected $classOrder = "Order";
	protected $classOrderLine = "OrderLine";

    protected $tableOrder   = "orders";
	protected $tableOrderLine = "order_line";
    protected $tableOrderStatus			= "webshop_order_statushistoryrow";

    protected static $allowedOrderBy		= array("last_name", "first_name", "email");
	protected static $allowedOrderDir		= array("ASC", "DESC");

    /**
	 * Constructor setting the params.
	 *
	 */
	public function __construct(private object $params) { }

    /**
	 * Get a list of Orders
	 *
     * @param string $orderBy
	 * @param string $orderDir
	 * @param int $offset
	 * @param int $count
	 * @return array[Supplier]|false
	 */
    public function getList($orderBy = "", $orderDir = "", $offset = 0, $count = 0) {

        $db = DB::loadDb();


        $sql = "SELECT `orders`.`id`, `orders`.`status`, 
            `orders`.`created`, `orders`.`updated`,
            `customers`.`first_name`,  `customers`.`last_name`,
            `users`.`username`
        FROM
            `$this->tableOrder`
        INNER JOIN customers ON orders.customer_id = customers.id
        INNER JOIN users ON orders.user_id = users.id
        ORDER BY
            updated
        DESC";

       


        return $db->selectObjects($sql, 'Order');
    }


    public function getOrder($id) {

        $id = (int) $id;

        $db = DB::loadDb();

        $sql = " SELECT *
            FROM `".$this->tableOrder."`
            WHERE `id` = '$id'";

        
        return $db->selectObject($sql, 'Order');

    }

    /**
	 * Gets the order lines for a given order.
	 *
	 * @param int $orderID
	 * @return array[mixed]
	 */
	public function getOrderLines($orderID)
	{
		$db = DB::loadDb();
        // Prepare query.
		$orderLinesQuery = "
			SELECT *
            FROM `".$this->tableOrderLine."` `sol`
            INNER JOIN products ON sol.product_id = products.id
			WHERE `sol`.`order_id` = ".$orderID;

        // Array with orderline objects.
	 	$orderLines = $db->selectObjects($orderLinesQuery, $this->classOrderLine, 'id');

        foreach($orderLines as &$orderLine)
	 		if ($orderLine->parentOrderLineID && isset($orderLines[$orderLine->parentOrderLineID]))
	 			$orderLine->setParent($orderLines[$orderLine->parentOrderLineID]);

		return $orderLines;
	}



    public function fillOrder(&$order) {


        $order->user_id =                 $_SESSION['id'];
        $order->customer_id =             $this->params->get('customer_select');
        $order->number =               $this->params->get('customer_number');
        $order->mail =                 $this->params->get('customer_email');
        $order->status =               $this->params->get('invoice_status');

        $order->shipping_name =        $this->params->get('shipping_name');
        $order->shipping_company =     $this->params->get('shipping_company');
        $order->shipping_street =      $this->params->get('shipping_street');
        $order->shipping_postalcode =  $this->params->get('shipping_postalcode');
        $order->shipping_city =        $this->params->get('shipping_city');
        $order->shipping_country =     $this->params->get('shipping_country');
        $order->billing_name =         $this->params->get('billing_name');
        $order->billing_company =      $this->params->get('billing_company');
        $order->billing_street =       $this->params->get('billing_street');
        $order->billing_postalcode =   $this->params->get('billing_postalcode');
        $order->billing_city =         $this->params->get('billing_city');
        $order->billing_country =      $this->params->get('billing_country');


        $order->updated = time();

        return $order;

    }


    public function saveOrder(&$order) {

        $db = DB::loadDb();

        if ($order->id > 0) {
            // update
            $db->update($this->tableOrder, $order, '`id` = '.$order->id);
        }
        else {
            //new

            $order->created = time();

            // Execute the insert query of product.
			$order->id = $db->insert($this->tableOrder, $order);

        }


        $db->delete($this->tableOrderLine, '`order_id` = '.$order->id);
        
        $total_products = count($this->params->get('product', array()));
        $products = $this->params->get('product', array());
        $productsQty = $this->params->get('qty', array());

        for($i=0; $i<$total_products; $i++) {

            $product = $products[$i];
            $qty = $productsQty[$i];

            
            $object = array(
                'order_id' => $order->id,
                'product_id' => $product,
                'quantity' => $qty
            );
            
            $db->insert($this->tableOrderLine, $object);
        }
    
        return true;
    }




}