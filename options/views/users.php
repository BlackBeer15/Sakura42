<?php 
    require_once('../php/connect.php');

    session_start();

    $verifUs = $conn->query('SELECT `login` FROM `users` WHERE `login` = "'.$_SESSION['user']['login'].'"');
    $rows = $verifUs->fetchAll();

	if (!$_SESSION['user'] || $rows[0]['login']==NULL) {
		header('Location: index.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/13c2a574f8.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="../styles/origin.css" />
    <link rel="stylesheet" href="../styles/header.css" />
    <link rel="stylesheet" href="../styles/products.css" />
    <link rel="stylesheet" href="../styles/users.css" />
    <link rel="stylesheet" href="../styles/media.css" />
    <title>Options</title>
</head>
<body>
    <header>
        <div>
            <p>Профиль: <span><?=$_SESSION['user']['name']?></span></p>
            <a href="../php/logout.php">Выйти</a>
        </div>
    </header>
    <main>
        <div class="alert-wrapper">
            <div class="window-alert">
                <i class="fa-solid fa-xmark"></i>
                <p class="error-send"></p>
            </div>
		</div>
        <div class="products-wrapper">
            <div class="all-products">
                <p class="title-all-prod">Все пользователи</p>
                <div class="prod-wrapper">
                    <?php
                        $use = $conn->query('SELECT `idUsers`, `name`, `Role`, `createDate` FROM `users` ORDER BY `createDate` DESC');
                        foreach ($use as $row) {
                            echo '
                                <div class="user-wrapper">
                                    <div class="about-user">
                                        <p>'.$row['name'].'</p> | <p>'.$row['Role'].'</p> | <p>'.$row['createDate'].'<p>
                                    </div>
                                    <button class="delete-btn" value="'.$row['idUsers'].'">Удалить</button>
                                </div>
                            ';
                        }
                    ?>
                </div>
            </div>
            <div class="create-products">
                <p class="title-create-prod">Добавление нового пользователя</p>
                <form class="create-event-form" enctype="multipart/form-data">
                    <div>
                        <p>Имя</p><input type="text" name="fname" maxlength="45" />
                    </div>
                    <div>
                        <p>Фамилия</p><input type="text" name="surname" />
                    </div>
                    <div>
                        <p>Логин</p><input type="text" name="login" />
                    </div>
                    <div>
                        <p>Пароль</p><input type="password" name="password" />
                    </div>
                    <div>
                        <p>Должность</p>
                        <select name="role">   
                            <option value="Администратор">Администратор</option>
                            <option value="Продавец">Продавец</option>
                        </select>
                    </div>
                    <div>
                        <input type="submit" name="send-us" class="send-us">
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
<script type="text/javascript" src="../js/ajax/addUs.js"></script>
<script type="text/javascript" src="../js/ajax/deleteUs.js"></script>
<script type="text/javascript" src="../js/alert.js"></script>
</html>