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

    // Methode om naar een naam te zoeken in verschillende tabellen
    public function zoekNaam($zoekterm) {
        $resultaten = [];

        // Tabellen waarin gezocht moet worden
        $tabellen = ['products', 'customers', 'suppliers'];

        // Zoeken in elke tabel
        foreach ($tabellen as $tabel) {
            $sql = "SELECT * FROM $tabel WHERE naam LIKE '%$zoekterm%'";
            $result = $this->conn->query($sql);

            // Resultaten toevoegen aan array
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $resultaten[$tabel][] = $row["naam"];
                }
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
    $username = ""; 
    $password = ""; 
    $dbname = ""; 

    $zoekterm = $_GET['zoekterm'];

    $zoeksysteem = new ZoekSysteem($servername, $username, $password, $dbname);
    $resultaten = $zoeksysteem->zoekNaam($zoekterm);

    // Resultaten weergeven
    echo "<h2>Resultaten</h2>";
    foreach ($resultaten as $tabel => $resultaat) {
        echo "<h3>$tabel</h3>";
        foreach ($resultaat as $naam) {
            echo "Naam: $naam<br>";
        }
    }

    // Als er geen resultaten zijn
    if (empty($resultaten)) {
        echo "Geen resultaten gevonden voor '$zoekterm'.";
    }

    // Verbinding sluiten
    $zoeksysteem->sluitVerbinding();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Zoek systeem</title>
</head>
<body>
    <h1>Zoek naar Naam</h1>
    <form method="GET" action="">
        <input type="text" name="zoekterm" required placeholder="Voer een naam in">
        <input type="submit" value="Zoeken">
    </form>
</body>
</html>
