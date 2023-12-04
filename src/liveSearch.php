<?php
if (isset($_POST["query"])) {
    require_once '../config/connect.php';

    $data = array();

    if ($_POST["query"] != '') {
        $condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $_POST["query"]);
        $condition = trim($condition);
        $condition = str_replace(" ", "%", $condition);

        $sample_data = array(
            ':id'                   => '%' . $condition . '%',
            ':product_name'         => '%' . $condition . '%',
            ':product_description'  => '%' . $condition . '%',
            ':product_quantity'     => '%' . $condition . '%',
            ':product_price'        => '%' . $condition . '%'
        );

        $quary  = "SELECT * FROM products
        WHERE id LIKE :id
        OR product_description LIKE :product_description
        OR product_quantity LIKE :product_quantity
        OR product_price LIKE :product_price
        ORDER BY id DESC";

        $stmt = $con->prepare($quary);
        $stmt->execute($sample_data);

        $result = $stmt->fetchAll();

        $replace_array_1 = explode("%", $condition);

        foreach($replace_array_1 as $row_data) {
            $replace_array_2[] = '<span>' . $row_data . '</span>';
        }

        foreach($result as $row) {
            $data[] = array(
                'id'                        => str_ireplace($replace_array_1, $replace_array_2, $row["id"]),
                'product_name'              => str_ireplace($replace_array_1, $replace_array_2, $row["product_name"]),
                'product_description'       => str_ireplace($replace_array_1, $replace_array_2, $row["product_description"]),
                'product_quantity'          => str_ireplace($replace_array_1, $replace_array_2, $row["product_quantity"]),
                'product_price'             => str_ireplace($replace_array_1, $replace_array_2, $row["product_price"])
            );
        }
    } else {
        $quary = "SELECT * FROM products ORDER BY id";

        $result = $con->query($quary);

        foreach($result as $row) {
            $data[] = array(
                'id'                        => $row["id"],
                'product_name'              => $row["product_name"],
                'product_description'       => $row["product_description"],
                'product_quantity'          => $row["product_quantity"],
                'product_price'             => $row["product_price"]
            );
        }
    }
    echo json_decode($data);
}
