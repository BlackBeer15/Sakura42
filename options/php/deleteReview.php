<?php
    try { 
        require_once('connect.php');
        $idReview=$_POST['idReview'];

        $queryDelete = $conn->exec("DELETE FROM `review` WHERE idReview='".$idReview."'");

        $response = [
            "status" => true,
            "message" => 'Отзыв успешно удалён'
        ];

        echo json_encode($response);
    } catch (Exception $e) {
		echo "Ошибка: " . $e->getMessage();
	}
?>