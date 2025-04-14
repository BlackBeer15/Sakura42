<?php
	session_start();
	require_once 'connect.php';

	$err=0;
	$login = $_POST['login'];
	$password = $_POST['password'];

	if (!empty($login) && !empty($password)) {
		$login = trim(($_POST['login']));
		$password = trim(($_POST['password']));
		$password = md5($password);
	} else {
		$err++;
		$response = [
    		"status" => false,
    		"message" => 'Все поля должны быть заполнены!'
    	];

    	echo json_encode($response);
	}

	if ($err == 0) {
		$chek_user = $conn->prepare("SELECT COUNT(*) FROM `users` WHERE `login` = '".$login."'"."AND `password` = '".$password."'");
		$chek_user->execute();
		$result_chek_user = $chek_user->fetchColumn();
		if ($result_chek_user > 0) {
			$queryUser = $conn->query("SELECT * FROM `users` WHERE `login` = '".$login."'"."AND `password` = '".$password."'");
			$queryUser->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $queryUser->fetch()) {  
				$_SESSION['user'] = [
					"id" => $row['idUsers'],
					"name" => $row['name'],
					"surname" => $row['surname'],
					"login" => $row['login']
				];
			}
			
			$response = [
				"status" => true
			];

			echo json_encode($response);
		} else {
			$response = [
    			"status" => false,
    			"message" => 'Логин или пароль введены неверно!'
    		];

    		echo json_encode($response);
		}
	}
?>