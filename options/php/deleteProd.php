<?php
    try { 
        require_once('connect.php');
        $idProduct=$_POST['idProduct'];

        $queryDelete = $conn->exec("DELETE FROM `product` WHERE idProduct='".$idProduct."'");

        $response = [
            "status" => true,
            "message" => 'Продукт успешно удалён'
        ];

        echo json_encode($response);
    } catch (Exception $e) {
		echo "Ошибка: " . $e->getMessage();
	}
?>