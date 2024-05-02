<?php
require_once '../src/inc/session_check.php';  
?>
<?php
class ZoekSysteem {
    private $conn;

    // Constructor om verbinding met de database te maken
    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Verbinding mislukt: " . $this->conn->connect_error);
        }
    }

    // Methode om naar verschillende namen en id's te zoeken in verschillende tabellen
    public function zoekNaamOfId($zoekterm) {
        $resultaten = [];

        // Zoeken in products tabel
        $resultaten['products'] = $this->zoekInTabel('products', 'product_name', 'id', $zoekterm);

        // Zoeken in customers tabel
        $resultaten['customers'] = $this->zoekInTabel('customers', 'first_name', 'id', $zoekterm);

        // Zoeken in suppliers tabel
        $resultaten['suppliers'] = $this->zoekInTabel('suppliers', 'name', 'id', $zoekterm);

        return $resultaten;
    }

    // Methode om in een specifieke tabel te zoeken naar een specifieke kolom met een zoekterm
    private function zoekInTabel($tabel, $naamKolom, $idKolom, $zoekterm) {
        $resultaten = [];

        $sql = "SELECT * FROM $tabel WHERE $naamKolom LIKE '%$zoekterm%' OR $idKolom = '$zoekterm'";
        $result = $this->conn->query($sql);

        // Resultaten toevoegen aan array
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resultaten[] = $row;
            }
        }

        return $resultaten;
    }

    // Methode om verbinding te sluiten
    public function sluitVerbinding() {
        $this->conn->close();
    }
}

// Gebruik van de ZoekSysteem klasse
if(isset($_GET['zoekterm'])){
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "inventoryManager"; 

    $zoekterm = $_GET['zoekterm'];

    $zoeksysteem = new ZoekSysteem($servername, $username, $password, $dbname);
    $resultaten = $zoeksysteem->zoekNaamOfId($zoekterm);

    // Sla de resultaten op in de sessie om door te sturen naar de resultatenpagina
    session_start();
    $_SESSION['resultaten'] = $resultaten;

    // Doorsturen naar de resultatenpagina
    header("Location:view-zoeken.php");
    exit;
}
?>











