<?php
    require_once('connect.php');

    $idProduct = $_POST['idProduct'];

    $card = $conn->query('SELECT * FROM `product` WHERE idProduct = '.$idProduct.'');
    $rows = $card->fetchAll();
	echo json_encode($rows);
?>