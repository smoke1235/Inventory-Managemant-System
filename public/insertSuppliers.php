<?php require_once '../src/inc/session_check.php';
require_once __DIR__ . '/../src/bootstrap.php';
view('header', ['title' => 'New supplier']);
?>

<h1>Add new supplier</h1>
<div class="form-container">
    <form action="../src/insertSuppliersForm.php">
        <label for="supplierName" name="supplierName">Supplier Name:*</label>
        <input type="text" name="supplierName" placeholder="Supplier" required>
        <label for="number">Phone Number:</label>
        <input type="tel" name="number" placeholder="06123456789">
        <label for="email">Email:</label>
        <input type="text" name="email" placeholder="supplier@example.nl">
        <label for="supplierStreet" name="supplierStreet">Street:</label>
        <input type="text" name="supplierStreet" placeholder="Street">
        <label for="supplierPostcode" name="supplierPostcode">Postal Code:</label>
        <input type="text" name="supplierPostcode" placeholder="Postal Code">
        <label for="supplierCity" name="supplierCity">City:</label>
        <input type="text" name="supplierCity" placeholder="City">
        <label for="supplierCountry" name="supplierCountry">Country:</label>
        <input type="text" name="supplierCountry" placeholder="Country">
        <input type="submit" name="submit" value="Submit">
        <a class="cancel-button" href="suppliers.php">Cancel</a>
    </form>
</div>
<?php view('footer') ?>