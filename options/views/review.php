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
    <link rel="stylesheet" href="../styles/review.css" />
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
                <p class="title-all-prod">Все Отзывы</p>
                <div class="prod-wrapper">
                    <?php
                        $allReviews = $conn->query('SELECT * FROM `review` ORDER BY `createDate` DESC');
                        foreach ($allReviews as $row) {
                            $rate = array();
                            $div = '<img src="../../images/star.png" alt="Оценка" />';

                            for ($i=0; $i<$row['rate']; $i++) {
                                array_push($rate, $div);
                            }

                            $printRate = implode(' ', $rate);

                            echo '
                                <div class="card-review">
                                    <div class="card-title-review">
                                        <div class="name-date">
                                            <p>'.$row['name'].'</p>
                                            <p>'.$row['createDate'].'</p>
                                        </div>
                                        <div class="user-img">
                                            <div class="avatar">
                                                <img src="../../'.$row['image'].'" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stars-wrapper">
                                        '.$printRate.'
                                    </div>
                                    <p class="review-comment">
                                        '.$row['comment'].'
                                    </p>
                                    <div class="delete-wrapper">
                                        <button class="delete-btn" value="'.$row["idReview"].'">Удалить</button>
                                    </div>
                                </div> ';
                        }
                    ?>
                </div>
            </div>
            <div class="create-products">
                <p class="title-create-prod">Добавление нового отзыва</p>
                <form class="create-event-form" enctype="multipart/form-data">
                    <div>
                        <p>Имя</p><input type="text" name="tittle" maxlength="45" />
                    </div>
                    <div>
                        <p class="without-bg">Фотография</p><input type="file" accept=".jpg, .jpeg, .png" name="cardPhoto" class="photo" />
                    </div>
                    <div>
                        <p>Дата</p><input type="date" name="datePub"/>
                    </div>
                    <div>
                        <p>Оценка</p>
                        <select name="mark">   
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div>
                        <p>Отзыв</p><textarea type="text" name="rev" maxlength="255" placeholder="ДО 255 СИМВОЛОВ!"></textarea>
                    </div>
                    <div>
                        <input type="submit" name="send-rev" class="send-rev">
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
<script type="text/javascript" src="../js/ajax/addReview.js"></script>
<script type="text/javascript" src="../js/ajax/deleteReview.js"></script>
<script type="text/javascript" src="../js/alert.js"></script>
</html>