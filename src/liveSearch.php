<?php

require_once '../src/inc/session_check.php';

$query = $params->get("query", false);
$pattern = DB::escapeStaticForSql($query, false, false);

$productManager = new ProductManger($params);
$productSearch 			= $productManager->searchProducts($pattern);

// If any product results are available.
if(count($productSearch))
{
    $return = "";
    foreach($productSearch as $product)
    {
        $return .= '
        <tr onclick="item(' . $product->id . ')">
        <td>' . $product->id . '</td>
        <td>' . $product->product_name . '</td>
        <td>' . $product->product_description . '</td>
        <td>' . $product->product_quantity . '</td>
        <td>&euro;' . $product->getPrice(true) . '</td>
        </tr>';
    }

    echo $return;
}
else {
    echo '<tr><td colspan="5" style="text-align: center;">No results Found.</td></tr>';
}

