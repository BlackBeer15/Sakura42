<?php
    try {
        require_once('connect.php');

        $role = $_POST['role'];
        $surname = $_POST['surname'];
        $name = $_POST['name'];
        $login = $_POST['login'];
        $password = $_POST['password'];

        if (!empty($role) && !empty($surname) && !empty($name) && !empty($login) && !empty($password)) {
            $log = $conn->query("SELECT count(*) FROM `users` WHERE `login` = '".$login."'");
            $log = $log->fetchAll();
            if ($log[0][0]==0) {
                if (iconv_strlen($password)>8) {
                    $password = md5($password);
                    $queryAddUser = $conn->exec("INSERT INTO `users` (`name`, `surname`, `login`, `password`, `Role`) values ('".$name."', '".$surname."', '".$login."', '".$password."', '".$role."')");
            
                    $response = [
                        "status" => true,
                        "message" => 'Новый пользователь создан!'
                    ];
    
                    echo json_encode($response);
                } else {
                    $response = [
                        "status" => false,
                        "message" => 'Слишком короткий пароль! (пароль должен быть не менее 8-ми символов)'
                    ];
        
                    echo json_encode($response);
                }   
            } else {
                $response = [
                    "status" => false,
                    "message" => 'Пользователь с таким логином уже существует!'
                ];
    
                echo json_encode($response);
            }
        } else {
            $response = [
                "status" => false,
                "message" => 'Все поля должны быть заполнены!'
            ];

            echo json_encode($response);
        }
         
    } catch (Exception $e) {
		echo "Ошибка: " . $e->getMessage();
	}
?>