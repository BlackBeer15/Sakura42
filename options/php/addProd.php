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

			$conn->beginTransaction();
			if (!empty($tittle) && !empty($ingredients) && !empty($price) && !empty($weight) && !empty($typeProd) && !empty($_FILES['cardPhoto'])) {
				$pathTittleIMG = 'images/cards/'.time().$_FILES['cardPhoto']['name'];
				if (move_uploaded_file($_FILES['cardPhoto']['tmp_name'], '../../'.$pathTittleIMG)) {
					$addevent = $conn->prepare("INSERT INTO `product` (`name`, `photo`, `aboutProd`, `price`, `weight`, `idUsers`, `typeProd`) values (:tittle, :tittleImage, :ingredients, :price, :weightP, :idUsers, :typeProd)");
					$addevent->bindParam(':tittle', $tittle);
					$addevent->bindParam(':tittleImage', $pathTittleIMG);
					$addevent->bindParam(':ingredients', $ingredients);
					$addevent->bindParam(':price', $price);
					$addevent->bindParam(':weightP', $weight);
					$addevent->bindParam(':typeProd', $typeProd);
					$addevent->bindParam(':idUsers', $_SESSION['user']['id']);
					
					if($addevent->execute()) {
						$conn->commit();
						$response = [
							"status" => true,
							"message" => 'Новый продукт успешно создан! :)'
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
						"message" => 'Произошла ошибка во время загрузки фото! Попробуйте ещё раз'
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