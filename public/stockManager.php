

<?php
      require_once '../src/inc/session_check.php';  

      class StockManager {
        private $db;
    
        public function __construct($db) {
            $this->db = $db;
        }
    
        public function checkStockLevels() {
            $warnings = "";
    
            $sql = "SELECT products.id, products.product_name, products.product_quantity, products.min_stock
                    FROM products";
            $result = $this->db->query($sql);
    
            while ($row = $result->fetch_assoc()) {
                $product_name = $row['product_name'];
                $product_quantity = $row['product_quantity'];
                $min_stock = $row['min_stock'];
    
                if ($product_quantity < $min_stock) {
                    $warnings .= "Low stock for product: $product_name. Current quantity: $product_quantity. Minimum stock: $min_stock.<br>";
                }
            }
    
            return $warnings;
        }
    }
       
             ?>