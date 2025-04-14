<?php
	session_start();
	require_once 'connect.php';
	$error = 0;
	try {

			$typeProd = $_POST['typeProd'];
			$tittle = $_POST['tittle'];
			$ingredients = $_POST['ingredients'];
			$price = $_POST['price'];
			$weight = $_POST['weight'];
            $idProduct = $_POST['idProduct'];

			$conn->beginTransaction();
			if (!empty($tittle) && !empty($ingredients) && !empty($price) && !empty($weight) && !empty($typeProd)) {
				
				$addevent = $conn->prepare("UPDATE `product` SET `name`=:tittle, `aboutProd`=:ingredients, `price`=:price, `weight`=:weightP, `idUsers`=:idUsers, `typeProd`=:typeProd WHERE `idProduct`=$idProduct");
				$addevent->bindParam(':tittle', $tittle);
				$addevent->bindParam(':ingredients', $ingredients);
				$addevent->bindParam(':price', $price);
				$addevent->bindParam(':weightP', $weight);
				$addevent->bindParam(':typeProd', $typeProd);
				$addevent->bindParam(':idUsers', $_SESSION['user']['id']);
				
				if($addevent->execute()) {
					$conn->commit();
					$response = [
						"status" => true,
						"message" => 'Продукт обновлён! :)'
					];
					echo json_encode($response);
				} else {
					$conn->commit();
					$response = [
						"status" => false,
						"message" => 'Что - то пошло не так :('
					];
					echo json_encode($response);
				}
			} else {
				$conn->rollback();
				$response = [
					"status" => false,
					"message" => 'Все поля обязательны к заполнению!'
				];
				echo json_encode($response);
			}
	} catch (Exception $e) {
		$conn->rollback();
		echo "Ошибка: " . $e->getMessage();
	}	
?>