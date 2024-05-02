<?php
require_once '../src/inc/session_check.php'; 
 view('header', ['title' =>  'Dashboard']); 
  ?>
<?php



// Controleer of resultaten in de sessie zijn opgeslagen
if(isset($_SESSION['resultaten'])){
    $resultaten = $_SESSION['resultaten'];
    unset($_SESSION['resultaten']); // Verwijder resultaten uit de sessie om opschonen

    // Toon de resultaten in een tabel
    echo "<h1>Zoekresultaten</h1>";
    echo "<table border='1'>";
    foreach ($resultaten as $tabel => $resultaat) {
        echo "<tr><th colspan='2'>$tabel</th></tr>";
        foreach ($resultaat as $row) {
            echo "<tr>";
            foreach ($row as $kolom => $waarde) {
                echo "<td>$kolom</td><td>$waarde</td>";
            }
            echo "</tr>";
        }
    }
    echo "</table>";
} else {
    echo "Geen resultaten gevonden.";
}
?>

