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
    <link rel="icon" href="images/fav.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="styles/origin.css" />
    <link rel="stylesheet" href="styles/header.css" />
    <link rel="stylesheet" href="styles/profile.css" />
    <title>Options</title>
</head>
<body>
    <header>
        <div>
            <p>Профиль: <span><?=$_SESSION['user']['name']?></span></p>
            <a href="php/logout.php">Выйти</a>
        </div>
    </header>
    <main>
        <div class="jop-panel">
			<a href="views/products">
				<p>Работа с меню</p>
			</a>
			<a href="views/users">
				<p>Сотрудники</p>
			</a>
            <a href="views/review">
				<p>Отзывы</p>
			</a>
		</div>
    </main>
</body>
</html>