<?php
    require_once('connect.php');

    $typeProd = $_POST['typeProd'];

    switch ($typeProd) {
        case "allMenu":
            $allProducts = $conn->query('SELECT * FROM `product` ORDER BY `createDate` ASC');
            $rows = $allProducts->fetchAll();
            echo json_encode($rows);
            break;
        case "allRolls":
            $allProducts = $conn->query('SELECT * FROM `product` WHERE `typeProd` IN("Холодные роллы", "Запечённые роллы", "Горячие роллы") ORDER BY `createDate` ASC');
            $rows = $allProducts->fetchAll();
            echo json_encode($rows);
            break;
        case "coldRolls":
            $allProducts = $conn->query('SELECT * FROM `product` WHERE `typeProd`="Холодные роллы" ORDER BY `createDate` ASC');
            $rows = $allProducts->fetchAll();
            echo json_encode($rows);
            break;
        case "bakedRolls":
            $allProducts = $conn->query('SELECT * FROM `product` WHERE `typeProd`="Запечённые роллы" ORDER BY `createDate` ASC');
            $rows = $allProducts->fetchAll();
            echo json_encode($rows);
            break;
        case "hotRolls":
            $allProducts = $conn->query('SELECT * FROM `product` WHERE `typeProd`="Горячие роллы" ORDER BY `createDate` ASC');
            $rows = $allProducts->fetchAll();
            echo json_encode($rows);
            break;
        case "sets":
            $allProducts = $conn->query('SELECT * FROM `product` WHERE `typeProd`="Сеты" ORDER BY `createDate` ASC');
            $rows = $allProducts->fetchAll();
            echo json_encode($rows);
            break;
        case "pizza":
            $allProducts = $conn->query('SELECT * FROM `product` WHERE `typeProd`="Пицца" ORDER BY `createDate` ASC');
            $rows = $allProducts->fetchAll();
            echo json_encode($rows);
            break;
        case "shaurma":
            $allProducts = $conn->query('SELECT * FROM `product` WHERE `typeProd`="Шаурма" ORDER BY `createDate` ASC');
            $rows = $allProducts->fetchAll();
            echo json_encode($rows);
            break;
        case "zakus":
            $allProducts = $conn->query('SELECT * FROM `product` WHERE `typeProd`="Закуски" ORDER BY `createDate` ASC');
            $rows = $allProducts->fetchAll();
            echo json_encode($rows);
            break;
    }
?>