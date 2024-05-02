<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<?php
view('header', ['title' =>  'Dashboard'])
?>
<nav class="navbar" id="navbar" aria-label="">
    <ul>
        <li>
            <button onclick="document.getElementsByClassName('sidebar')[0].classList.toggle('collapsed')">
                <ion-icon name="menu-outline"></ion-icon>
            </button>
        </li>
        <li>
            <a href="dashboard.php">
                <h1>Inventory Manager</h1>
            </a>
        </li>
    </ul>
    <ul>
         <li>
            <?php include_once 'searchManager.php';  ?>
            <form method="GET" action="">
                <input class="zoek"  type="text" name="zoekterm" required placeholder="Voer een naam of nummer in">
                <input id="button" type="submit" value="Zoeken">
            </form>
        </li>
    </ul>
    <ul>

        <li><a href="profile.php">Profile</a></li>
        <li><a href="../src/logout.php">Logout</a></li>
    </ul>
</nav>

<nav class="sidebar" id="sidebar" aria-label="">
<img src="../assets/img/TEEUWEN_logo_transparant-min.png" alt="Company logo" height="auto" width="80%">
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="invoice.php">Invoices</a></li>
        <li><a href="order.php">Orders</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="customers.php">Customers</a></li>
        <li><a href="suppliers.php">Suppliers</a></li>
    </ul>
</nav>
