<?php require_once '../config/connect.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iventory Manager | Add product for invoice</title>
    <link rel="stylesheet" href="../assets/CSS/popup.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../assets/js/showProductResult.js"></script>
</head>

<body>
    <div class="container">
        <div class="input-container">
            <h1>Search Product</h1>
            <input type="text" name="search" id="search" placeholder="Search">
            <div class="results-container">
                <table aria-label="">
                    <thead>
                        <tr>
                            <th id="number">No.</th>
                            <th id="product">Product</th>
                            <th id="desc">Description</th>
                            <th id="qty">Qty</th>
                            <th id="price">Price</th>
                        </tr>
                    </thead>
                    <tbody id="result"></tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
