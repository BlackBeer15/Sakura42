<?php 
	require_once('connect.php');

	$queryMenu = $conn->query('SELECT * FROM `product_user` ORDER BY `createDate` DESC');
	$rows = $queryMenu->fetchAll();
	echo json_encode($rows);
?>