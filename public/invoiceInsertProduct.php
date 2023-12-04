<?php require_once '../config/connect.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iventory Manager | Add product for invoice</title>
    <link rel="stylesheet" href="../assets/CSS/popup.css">
    <script src="../assets/js/showProductResult.js"></script>
</head>

<body>
    <div class="container">
        <div class="input-container">
            <h1>Search Product</h1>
            <input type="text" name="search" id="search" placeholder="Search" onkeyup="load_data(this.value);">
            <div class="results-container">
                <table id="">
                    <thead>
                        <tr>
                            <th id="number">No.</th>
                            <th id="product">Product</th>
                            <th id="desc">Description</th>
                            <th id="qty">Qty</th>
                            <th id="price">Price</th>
                        </tr>
                    </thead>
                    <tbody id="post_data"></tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
