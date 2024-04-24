

<?php
      require_once '../src/inc/session_check.php';  

        class StockManager {
                private $db;
                private $minStockLevels;
                  
             public function __construct($db, $minStockLevels) {
                     $this->db = $db;
                     $this->minStockLevels = $minStockLevels;
                     
                }
       
       
       
             public function checkStockLevels() {
                     $warnings = "";
                  
                  
       
                   foreach ($this->minStockLevels as $product => $minStockLevel) {
                         $sql = "SELECT product_quantity FROM products WHERE product_name='$product'";
                            $result = $this->db->query($sql);
                           $row = $result->fetch_assoc();
                           
                          $stockLevel = $row['product_quantity'];
                          
                          
                   
                   if ($stockLevel < $minStockLevel) {
                       $warnings .= "Waarschuwing: De voorraad van $product is te laag. Huidige voorraad: $stockLevel  .<br>";
                       
                   }
               }
       
               return $warnings;
                }
            }
       
                 // Minimale voorraadniveaus
   
       
                 // Maak een instantie van de StockManager-klasse
                $stockManager = new StockManager($con, $minimale_voorraad);
               // Roep de methode aan om voorraadniveaus te controleren
                 $warnings = $stockManager->checkStockLevels();
       
                // Toon de waarschuwingen
                if (!empty($warnings)) {
                echo "<div>$warnings</div>";
               
              }
       
             ?>