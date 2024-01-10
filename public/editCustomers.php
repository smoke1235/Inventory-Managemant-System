<?php
require_once '../src/inc/session_check.php';
require_once __DIR__ . '/../src/bootstrap.php';
view('header', ['title' =>  'Edit customers']);

$id = $_GET['id'];
$sql =
"SELECT * FROM customers
WHERE id= $id";
$result = mysqli_query($con, $sql);
$row = $result->fetch_assoc();
?>

            <h1>Edit <?php echo $row['first_name'] . ' ' . $row['last_name']; ?></h1>
            <div class="form-container">
                <form action="../src/editCustomersForm.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <label for="newFirstName" name="newFirstName">First Name:</label>
                    <input type="text" name="newFirstName"
                    placeholder="First name" value="<?php echo $row['first_name']; ?>" maxlength="80">
                    <label for="newLastName" name="newLastName">Last Name:</label>
                    <input type="text" name="newLastName"
                    placeholder="Last name" value="<?php echo $row['last_name']; ?>" maxlength="80">
                    <label for="number">Phone number:</label>
                    <input type="tel" name="number"
                    placeholder="06123456789" value="<?php echo $row['number']; ?>" maxlength="15">
                    <label for="email">Email:</label>
                    <input type="text" name="email"
                    placeholder="customer@example.nl" value="<?php echo $row['email']; ?>" maxlength="200">
                    <label for="newCompanyName">Company Name:</label>
                    <input type="text" name="newCompanyName"
                    placeholder="Company name" value="<?php echo $row['company_name']; ?>" maxlength="100">
                    <label for="newStreet" name="newCompanyName">Street:</label>
                    <input type="text" name="newStreet"
                    placeholder="Street:" value="<?php echo $row['street']; ?>" maxlength="90">
                    <label for="newPostcode" name="newPostcode">Postcode</label>
                    <input type="text" name="newPostcode"
                    placeholder="Postcode" value="<?php echo $row['postcode']; ?>" maxlength="8">
                    <label for="newCity" name="newCity">City:</label>
                    <input type="text" name="newCity"
                    placeholder="City" value="<?php echo $row['city']; ?>" maxlength="90">
                    <label for="newCountry" name="newCountry">Country:</label>
                    <input type="text" name="newCountry"
                    placeholder="Country" value="<?php echo $row['country']; ?>" maxlength="60">
                    <input type="submit" name="submit" value="Submit">
                    <a class="cancel-button" href="customers.php">Cancel</a>
                </form>
            </div>
<?php view('footer'); ?>
