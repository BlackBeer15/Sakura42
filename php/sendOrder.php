<?php
    require_once('connect.php');

    date_default_timezone_set("Asia/Krasnoyarsk");

    //Токен бота
    $token = "7255199761:AAG1W1HOwp5o_-xFYiadaQo9MB8muB4keQM";

    //id чата
    $chat_id = "-1002214111756";

    $cart = $_POST['cart'];
    $userName = $_POST['userName'];
    $phone = $_POST['phone'];
    $typeDelivery = $_POST['typeDelivery'];
    $typePayment = $_POST['typePayment'];
    $area = $_POST['area'];

    $allProd = array();
    $textProd = array();
    $p=1;

    $surcharge = 0;

    $totalPrice = 0;

    if(preg_match('/[А-Яа-я]/', $userName) && preg_match('!^\+7\(\d{3}\) \d{3}(-\d{2}){2}$!', $phone)) {
        $valid = true;
    } else {
        $valid = false;
    }


    if ($typeDelivery == 'Доставка' && $valid == true && ($typePayment == 'Картой курьеру' || $typePayment == 'Наличными')) {
        $street = $_POST['street'];
        $home = $_POST['home'];
        $korpus = $_POST['korpus'];
        $entrance = $_POST['entrance'];
        $floor = $_POST['floor'];
        $appartament = $_POST['appartament'];
        $homePhone = $_POST['homePhone'];

        $strNumValid = $korpus.$entrance.$floor.$appartament.$homePhone;

        if (ctype_digit($strNumValid)) {
            $numValid = true;
        } else if (empty($strNumValid)) {
            $numValid = true;
        } else {
            $numValid = false;
        }

        if (!empty($userName) && !empty($phone) && !empty($street) && !empty($home) && $numValid==true) {

            foreach ($cart as $id => $value) {
                $prod = $conn->query('SELECT * FROM `product` WHERE idProduct = '.$id.'');
                $rows = $prod->fetchAll();
        
                array_push($rows[0], $value);
                
                array_push($allProd, $rows);

            }

            for ($i=0; $i < count($allProd); $i++) {
                $position = "\xE2\x9C\x85<b>Позиция №".$p."</b> - <u>".$allProd[$i][0][1]."</u>\n<b>Количество:</b> <u>".$allProd[$i][0][9]." шт.</u>\n<b>Цена за штуку:</b> <u>".$allProd[$i][0][4]." ₽</u>\n\n";
                array_push($textProd, $position);
                $p++;

                $totalPrice = $allProd[$i][0][4] * $allProd[$i][0][9] + $totalPrice;
            }

            switch ($area) {
                case 'р-н Кузнецкий':
                    if ($totalPrice < 800) {
                        $totalPrice = $totalPrice + 150;
                        $surcharge = 150;
                    }
                    break;
                case 'р-н Орджоникидзевский':
                    if ($totalPrice < 1800) {
                        $totalPrice = $totalPrice + 250;
                        $surcharge = 250;
                    }
                    break;
                case 'р-н Центральный':
                    if ($totalPrice < 1700) {
                        $totalPrice = $totalPrice + 200;
                        $surcharge = 200;
                    }
                    break;
                case 'р-н Заводской':
                    if ($totalPrice < 2000) {
                        $totalPrice = $totalPrice + 250;
                        $surcharge = 250;
                    }
                    break;
                case 'р-н Новоильинский':
                    if ($totalPrice < 2000) {
                        $totalPrice = $totalPrice + 350;
                        $surcharge = 350;
                    }
                    break;
            }            

            $printProducts = implode(' ', $textProd);

            $messageTg = "\xE2\x9D\x97 <b>ЗАКАЗ ОТ ".date("d-m-y H:i:s")." </b>\xE2\x9D\x97 \n-----------------------------------------------------------\n                           <b>".$typeDelivery."</b>\xF0\x9F\x9A\x80 \n-----------------------------------------------------------\n<b>Имя заказчика: </b><u>".$userName."</u>\n<b>Номер телефона: </b><u>".$phone."</u>\n-----------------------------------------------------------\n ".$printProducts."\n-----------------------------------------------------------\n                   \xF0\x9F\x8F\xA0<b>Куда доставить:</b>\n-----------------------------------------------------------\n<b>Район:</b><u>".$area."</u>\n<b>Улица:</b><u>".$street."</u>\n<b>Дом:</b><u>".$home."</u>\n<b>Корпус:</b><u>".$korpus."</u>\n<b>Подъезд:</b><u>".$entrance."</u>\n<b>Этаж:</b><u>".$floor."</u>\n<b>Квартира:</b><u>".$appartament."</u>\n<b>Домофон:</b><u>".$homePhone."</u>\n-----------------------------------------------------------\n<b>Доплата за доставку: </b><u>".$surcharge." ₽</u>\n<b>Общая сумма заказа: </b><u>".$totalPrice." ₽</u>\n<b>Способ оплаты: </b><u>".$typePayment."</u>";

            $messageTg = urlencode($messageTg);
            
            $sendToTelegram = fopen("https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&parse_mode=html&text=".$messageTg."","r");

            if ($sendToTelegram) {
                $response = [
                    "status" => true,
                    "message" => 'Ваш заказ принят! Совсем скоро наш оператор перезвонит Вам для подтверждения заказа. Спасибо за заказ!'
                ];
        
                echo json_encode($response);
            } else {
                $response = [
                    "status" => false,
                    "message" => "Произошла ошибка... =( Мы скоро это исправим!"
                ];
        
                echo json_encode($response);
            }
        } else {
            $response = [
                "status" => false,
                "message" => 'Все обязательные поля* должны быть заполнены! Заполнены корректно!'
            ];
            echo json_encode($response);
        }
    } elseif (!empty($userName) && !empty($phone) && $typeDelivery == 'Самовывоз' && $valid == true) {

        $cookTime = $_POST['cookTime'];

        foreach ($cart as $id => $value) {
            $prod = $conn->query('SELECT * FROM `product` WHERE idProduct = '.$id.'');
            $rows = $prod->fetchAll();
    
            array_push($rows[0], $value);
            
            array_push($allProd, $rows);

        }

        for ($i=0; $i < count($allProd); $i++) {
            $position = "\xE2\x9C\x85<b>Позиция №".$p."</b> - <u>".$allProd[$i][0][1]."</u>\n<b>Количество:</b> <u>".$allProd[$i][0][9]." шт.</u>\n<b>Цена за штуку:</b> <u>".$allProd[$i][0][4]." ₽</u>\n\n";
            array_push($textProd, $position);
            $p++;

            $totalPrice = $allProd[$i][0][4] * $allProd[$i][0][9] + $totalPrice;
        }

        $printProducts = implode(' ', $textProd);

        $messageTg = "\xE2\x9D\x97 <b>ЗАКАЗ ОТ ".date("d-m-y H:i:s")." </b>\xE2\x9D\x97 \n-----------------------------------------------------------\n                       <b>".$typeDelivery."</b>\xF0\x9F\x91\xA3 \n-----------------------------------------------------------\n<b>Имя заказчика: </b><u>".$userName."</u>\n<b>Номер телефона: </b><u>".$phone."</u>\n-----------------------------------------------------------\n ".$printProducts."\n-----------------------------------------------------------\n       \xF0\x9F\x95\x9C<b>Время получения заказа:</b>\n                     <b><u>".$cookTime."</u></b>\n-----------------------------------------------------------\n<b>Общая сумма заказа: </b><u>".$totalPrice." ₽</u>\n";

        $messageTg = urlencode($messageTg);
        
        $sendToTelegram = fopen("https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&parse_mode=html&text=".$messageTg."","r");

        if ($sendToTelegram) {
            $response = [
                "status" => true,
                "message" => 'Ваш заказ принят! Совсем скоро наш оператор перезвонит Вам для подтверждения заказа. Спасибо за заказ!'
            ];
    
            echo json_encode($response);
        } else {
            $response = [
                "status" => false,
                "message" => "Произошла ошибка... =( Мы скоро это исправим!"
            ];
    
            echo json_encode($response);
        }
    } else {
        $response = [
            "status" => false,
            "message" => 'Все обязательные поля* должны быть заполнены! Заполнены корректными данными!'
        ];
        echo json_encode($response);
    }
?>