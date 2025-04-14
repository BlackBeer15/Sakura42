<?php
    require_once('../php/connect.php');

    session_start();

    $verifUs = $conn->query('SELECT `login` FROM `users` WHERE `login` = "'.$_SESSION['user']['login'].'"');
    $rows = $verifUs->fetchAll();

	if (!$_SESSION['user'] || $rows[0]['login']==NULL) {
		header('Location: index.php');
	}

    @$idProduct = $_GET['id'];

    $queryProd = $conn->prepare("SELECT * FROM `product_user` WHERE `idProduct`='".$idProduct."'");
    $queryProd->execute();

    $queryProd1 = $conn->prepare("SELECT * FROM `product_user` WHERE `idProduct`='".$idProduct."'");
    $queryProd1->execute();
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
    <link rel="stylesheet" href="../styles/redactor.css" />
    <link rel="stylesheet" href="../styles/mediaRed.css" />
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
        <?php
            foreach ($queryProd as $row) {
                echo '
                    <div class="product-card">
                        <div class="card-image" style="background-image: url('.'../../'.$row['photo'].');"></div>
                        <div class="info-product">
                            <p class="name-prod">'.$row['nameProd'].'</p>
                            <p class="type-prod">'.$row['typeProd'].'</p>
                            <p class="about-prod">'.$row['aboutProd'].'</p>
                            <p class="price-weight">Цена: '.$row['price'].' ₽  Вес: '.$row['weight'].' гр.</p>
                        </div>
                    </div>
                ';
            }
        ?>
        <form class="update-product" enctype="multipart/form-data">
            <?php
                foreach ($queryProd1 as $row1) {
                    echo '
                        <input type="text" value="'.$idProduct.'" name="idProduct" hidden/>
                        <div>
                            <select name="typeProd">   
                                <option value="Холодные роллы">Холодные роллы</option>
                                <option value="Запечённые роллы">Запечённые роллы</option>
                                <option value="Горячие роллы">Горячие роллы</option>
                                <option value="Сеты">Сеты</option>
                                <option value="Шаурма">Шаурма</option>
                                <option value="Пицца">Пицца</option>
                                <option value="Закуски">Закуски</option>
                            </select>
                        </div>
                        <div>
                            <p>Наименование</p><input type="text" name="tittle" value="'.$row1['nameProd'].'" maxlength="45" placeholder="ДО 45 СИМВОЛОВ!" />
                        </div>
                        <div>
                            <p>Состав</p><textarea type="text" name="ingredients" maxlength="255" placeholder="ДО 255 СИМВОЛОВ!">'.$row1['aboutProd'].'</textarea>
                        </div>
                        <div>
                            <p>Цена (₽)</p><input type="text" name="price" value="'.$row1['price'].'" />
                        </div>
                        <div>
                            <p>Вес (в граммах, (гр.) указывать не нужно)</p><input type="text" name="weight" value="'.$row1['weight'].'" />
                        </div>
                    ';
                }
            ?>
            <div>
                <input type="submit" name="send-event" class="send-event">
            </div>
		</form>
    </main>
</body>
<script type="text/javascript" src="../js/ajax/updateProduct.js"></script>
<script type="text/javascript" src="../js/alert.js"></script>
</html>