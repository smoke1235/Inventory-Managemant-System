

<?php
      require_once '../src/inc/session_check.php';  

      class StockManager {
        private $db;
        
        public function __construct($db) {
            $this->db = $db;
        }
    
        public function checkStockLevels() {
            $warnings = "";
    
            $sql = "SELECT product_name, product_quantity, min_stock FROM products";
            $result = $this->db->query($sql);
    
            while ($row = $result->fetch_assoc()) {
                $product = $row['product_name'];
                $stockLevel = $row['product_quantity'];
                $minStockLevel = $row['min_stock'];
    
                if ($stockLevel < $minStockLevel) {
                    $warnings .= "Waarschuwing: De voorraad van $product is te laag. Huidige voorraad: $stockLevel. Minimale voorraad: $minStockLevel.<br>";
                }
            }
    
            return $warnings;
        }
    }
    
    // Maak een instantie van de StockManager-klasse
    $stockManager = new StockManager($con);
    
    // Roep de methode aan om voorraadniveaus te controleren
    $warnings = $stockManager->checkStockLevels();
    
    // Toon de waarschuwingen
    if (!empty($warnings)) {
        echo "<div>$warnings</div>";
    }
       
             ?>