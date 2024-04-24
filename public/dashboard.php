<?php
require_once '../src/inc/session_check.php';
view('header', ['title' =>  'Dashboard'])
?>

<h1>Welcome,
    <?= $_SESSION['name'] ?>!
</h1>
<div class="board">
    <div class="products-button">
        <?php
        
        $sql = "SELECT COUNT(product_name) AS total FROM products;";
        $result = mysqli_query($con, $sql);
        $data = mysqli_fetch_assoc($result);
        ?>
        <a href="products.php"
            title="This shows you how many products we have in the system, 
            You also can click it to go straight to the product page.">
            <h3>
                <?php
                echo $data['total'];
                
                ?>
            </h3>
            <p>Total products</p>
        </a>
    </div>
    <div class="customers-button">
        <?php
        $sql = "SELECT COUNT(id) AS total FROM customers;";
        $result = mysqli_query($con, $sql);
        $data = mysqli_fetch_assoc($result);
        
        ?>
        <a href="customers.php"
            title="This shows how many customers we have in the system, 
            you also can click it to go straight to the customers page.">
            <h3>
                <?php
                echo $data['total'];
                

                ?>
            </h3>
            <p>Total Customers</p>
        </a>
    </div>
    <div class="suppliers-button">
        <?php
        $sql = "SELECT COUNT(name) AS total FROM suppliers;";
        $result = mysqli_query($con, $sql);
        $data = mysqli_fetch_assoc($result);
        ?>
        <a href="suppliers.php"
            title="This shows how many suppliers we have in the system, 
            you also can click it to go straight to the suppliers page.">
            <h3>
                <?php
                echo $data['total'];
                ?>
            </h3>
            <p>Total Suppliers</p>
        </a>
    </div>
    <div class="orders-button">
        <?php
        $sql = "SELECT COUNT(id) AS total FROM invoices WHERE MONTH(updated) = MONTH(CURRENT_DATE) ORDER BY updated;";
        $result = mysqli_query($con, $sql);
        $data = mysqli_fetch_assoc($result);
        ?>
        <a href="invoice.php"
        title="This shows how many invoiced are logged in the system. 
        You can also click the counter to go straight to the invoice page.">
            <h3>
                <?php echo $data['total']; ?>
            </h3>
            <p>Invoices this month</p>
        </a>
    </div>
</div>
<div class="dashboard-table">
    <h2>Recently added products</h2>
    <div class="dashboard-table-container">
        <table aria-label="A table that shows 30 newly added products">
            <thead>
                <tr>
                    <th>No.</th>
                    <th id="dash-name">Name</th>
                    <th id="dash-descr">Description</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php
            $sql = "SELECT
                        products.id,
                        products.product_name,
                        products.product_description,
                        products.product_quantity,
                        products.product_price,
                        products.other_details,
                        suppliers.name, date
                    FROM
                        products
                    INNER JOIN suppliers ON products.supplier_id=suppliers.id
                    ORDER BY
                        date
                    DESC
                    LIMIT 0,30";
            $result = $con->query($sql);
            


            $minimale_voorraad =array(
                "A5 Poster" => 60,
                "Verf" => 30,
                "poster" => 100,
            );
            
         

            ?>
            <tbody>
                <?php while ($rows = $result->fetch_assoc()) { ?>
                    <?php echo""; ?>
                    <tr>
                        <td id="dash-id">
                            <?php echo $rows['id']; ?>
                        </td>
                        <td id="dash-name">
                            <?php echo $rows['product_name']; ?>
                        </td>
                        <td id="dash-descr">
                            <?php echo $rows['product_description']; ?>
                        </td>
                        <td class="pro-qty <?php echo ($rows['product_quantity'] < $minimale_voorraad[$rows['product_name']]) ? 'low-stock' : ''; ?>">
                        <?php echo $rows['product_quantity']; ?>
                        <?php if ($rows['product_quantity'] < $minimale_voorraad[$rows['product_name']]): ?>
                            <span style="color : red;">(Low stock!)</span> 
                        <?php endif; ?>
                        </td>
                        <td id="dash-prc">
                            <?php echo $rows['product_price']; ?>
                        </td>
                        <td id="dash-act">
                            <a class="edit-data" href="editProduct.php?id=<?php echo $rows['id']; ?>">
                                <ion-icon name="pencil-outline"></ion-icon>
                            </a>
                            <a class="view-data" href="view-product.php?id=<?php echo $rows['id']; ?>">
                                <ion-icon name="eye-outline"></ion-icon>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
        

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

         <?php
        

     class CommentManager {
            private $con;
        
                public function __construct($con) {
                       $this->con = $con;
             }

     public function getComments() {
                             $sql = "SELECT * FROM comments";
                             $result = $this->con->query($sql);
                         while($row = $result->fetch_assoc()) {
                                 echo "<div class='comment-box'><p>";
                                 echo $row['name']. "<br>";
                                  echo $row['data']. "<br>";
                                 echo nl2br($row['message']);
                                 
                             echo "</p>
        
                            <form class='edit-btn-belete' method='POST' action=''>
                                    <input type='hidden' name='cid' value='".$row['cid']."'>
                                    <button type='submit' name='commentDelete'>Delete</button>
                            </form>
        
                            <form class='edit-btn' method='POST' action='editcomment.php'>
                                     <input type='hidden' name='cid' value='".$row['cid']."'>
                                     <input type='hidden' name='name' value='".$row['name']."'>
                                     <input type='hidden' name='data' value='".date('Y-m-d H:i:s')."'>
                                     <input type='hidden' name='message' value='".$row['message']."'>
                                     <button>Edit</button>
                            </form>
                    </div>";
                }
            }
        
                public function deleteComment($cid) {
                          $sql= "DELETE FROM comments WHERE cid='$cid'";
                         $result = $this->con->query($sql);
                        
            }
          }

     class Comment {
            private $con;
            private $name;
            private $data;
            private $message;
        
           
                    public function __construct($con, $name, $data, $message) {
                         $this->con = $con;
                         $this->name = $name;
                         $this->data = $data;
                         $this->message = $message;
            }
        

                    public function saveComment() {
                         $sql = "INSERT INTO comments (name, data, message) VALUES ('$this->name', '$this->data', '$this->message')";
                         $result = $this->con->query($sql);
                  
            }
        }
        
        // Gebruik van de klassen
        
                            $commentManager = new CommentManager($con);
        
                      if (isset($_POST['commentSubmit'])) {
                            $comment = new Comment($con, $_POST['name'], $_POST['data'], $_POST['message']);
                            $comment->saveComment();
            
         }
        
                    if (isset($_POST['commentDelete'])) {
                           $commentManager->deleteComment($_POST['cid']);
            
        }
      
           echo "<form method='POST' action=''>
                     <input  type='hidden' name='name' value='".$_SESSION['name']."'>
                     <input  type='hidden' name='data' value='".date('Y-m-d H:i:s')."'>
                      <textarea class='message' name='message' required placeholder='Voeg uw opmerking toe..'></textarea><br>
                     <button class='butcomment' type='submit' name='commentSubmit'>Comment</button>
          </form>";
        
        $commentManager->getComments();
    

        ?>

        </div>
</div>



<?php view('footer'); ?>

