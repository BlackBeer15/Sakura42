<?php
    try { 
        require_once('connect.php');
        $idUs=$_POST['idUs'];

        $queryDelete = $conn->exec("DELETE FROM `users` WHERE idUsers='".$idUs."'");

        $response = [
            "status" => true,
            "message" => 'Пользователь успешно удалён!'
        ];

        echo json_encode($response);
    } catch (Exception $e) {
		echo "Ошибка: " . $e->getMessage();
	}
?>