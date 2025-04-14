<?php
    require_once('connect.php');

    $cart = $_POST['cart']; 
    $resp = array();

    foreach ($cart as $id => $value) {
        $prod = $conn->query('SELECT * FROM `product` WHERE idProduct = '.$id.'');
        $rows = $prod->fetchAll();

        array_push($resp, $rows);
    }

    echo json_encode($resp);
?>