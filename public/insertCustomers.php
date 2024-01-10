<?php
require_once '../src/inc/session_check.php';
require_once __DIR__ . '/../src/bootstrap.php';
view('header', ['title' => 'New customer'])
?>

<h1>Add new customer</h1>
<div class="form-container">
    <form action="../src/insertCustomersFrom.php">
        <label for="firstName" name="firstName">Fisrt Name:</label>
        <input type="text" name="firstName" placeholder="First Name">
        <label for="lastName" name="lastName">Last name:*</label>
        <input type="text" name="lastName" placeholder="Last Name" required>
        <label for="number">Phone Number:*</label>
        <input type="tel" name="number" placeholder="06123456789" required>
        <label for="email">Email:</label>
        <input type="text" name="email" placeholder="someone@exaple.com">
        <label for="companyName" name="companyName">Company name:</label>
        <input type="text" name="companyName" placeholder="Company Name">
        <label for="customerStreet" name="customerStreet">Street:</label>
        <input type="text" name="customerStreet" placeholder="Street">
        <label for="customerPostcode" name="customerPostcode">Postal Code:</label>
        <input type="text" name="customerPostcode" placeholder="Postal Code">
        <label for="customerCity" name="customerCity">City:</label>
        <input type="text" name="customerCity" placeholder="City">
        <label for="customerCountry" name="customerCountry">Country:</label>
        <input type="text" name="customerCountry" placeholder="Country">
        <input type="submit" name="submit" value="Submit">
        <a class="cancel-button" href="customers.php">Cancel</a>
    </form>
</div>
<?php view('footer'); ?>
