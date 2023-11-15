<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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
        <li><a href="profile.php">Profile</a></li>
        <li><a href="../src/logout.php">Logout</a></li>
    </ul>
</nav>

<nav class="sidebar" id="sidebar" aria-label="">
<img src="../assets/img/TEEUWEN_logo_transparant-min.png" alt="Company logo" height="10%" width="100%">
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="orders.php">Orders</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="customers.php">Customers</a></li>
        <li><a href="suppliers.php">Suppliers</a></li>
        <li><a href="help.php">Help</a></li>
    </ul>
</nav>
