<?php
    require_once('php/connect.php');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/fav.ico" type="image/x-icon"/>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/SmoothScroll.min.js"></script>
    <script src="js/jquery.color-2.2.0.min.js"></script>
    <link rel="stylesheet" href="styles/swiper-bundle.min.css" />
    <link rel="stylesheet" href="styles/origin.css" />
    <link rel="stylesheet" href="styles/header.css" />
    <link rel="stylesheet" href="styles/background.css" />
    <link rel="stylesheet" href="styles/about.css" />
    <link rel="stylesheet" href="styles/menu.css" />
    <link rel="stylesheet" href="styles/delivery.css" />
    <link rel="stylesheet" href="styles/review.css" />
    <link rel="stylesheet" href="styles/footer.css" />
    <link rel="stylesheet" href="styles/media/mediaHeader.css" />
    <link rel="stylesheet" href="styles/media/mediaAbout.css" />
    <link rel="stylesheet" href="styles/media/mediaMenu.css" />
    <link rel="stylesheet" href="styles/media/mediaDelivery.css" />
    <link rel="stylesheet" href="styles/media/mediaReview.css" />
    <link rel="stylesheet" href="styles/media/mediaFooter.css" />
    <link href="fontawesome/css/all.min.css" rel="stylesheet" />
    <title>Сакура - доставка еды в Новокузнецке</title>
</head>
<body>
    <div class="open-card-wrapper"></div>
    <header>
        <i class="fa-solid fa-cart-shopping">
            <a href="cart" onclick="window.scrollTo(0,0);"></a>
            <div class="amount-prod">1</div>
        </i>
        <div class="container">
            <div class="navbar__wrap">
                <a href="https://sakura42.ru" class="logo">
                    <img src="images/logo.png" alt="Логотип - Сакура" />
                </a>
                <ul class="menu" id="menu">
                    <li>
                        <a href="#menus">Меню</a> 
                    </li>
                    <li>
                        <a href="#delivery">Доставка</a>
                    </li>
                    <li>
                        <a href="#reviews">Отзывы</a> 
                    </li>
                    <li>
                        +7(905)961-42-22
                    </li>
                </ul>
                <div class="hamb">
                    <div class="hamb__field" id="hamb">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup" id="popup"></div>
    </header>
    <main>
        <div class="bg-wrapper">
            <div class="mobile-gradient"></div>
            <div class="sushi" id="sushi"></div>
            <img src="images/bgAbout.jpg" class="vid-sak"/>
        </div>
        <div class="wrapper-all">
            <div class="about-company">
                <p class="hi-words">Удобная доставка вкусных блюд прямо к вашему столу</p>
                <p class="about-words">Свежие блюда с доставкой — наслаждайтесь лучшим, не выходя из дома.</p>
                <div class="about-wrapper-buttons">
                    <a href="#menus">
                        Заказать
                    </a>
                    <p>Режим работы: 10:00 - 22:00<span>Принятие заказов до 21:30</span></p>
                </div>
                <div class="about-wrapper-skill">
                    <div>
                        <img src="images/chef.png" alt="Повар" />
                        <p>Профессиональные повара</p>
                    </div>
                    <div>
                        <img src="images/fish.png" alt="Рыба" />
                        <p>Только свежие продукты</p>
                    </div>
                    <div>
                        <img src="images/car.png" alt="Повар" />
                        <p>Доставка до Вашего дома</p>
                    </div>
                </div>
            </div>
            <div class="menu-wrapper">
                <div class="title-menu" id="menus">
                    <p>Меню</p>
                    <img src="images/line.png" alt="Палочка" />
                </div>
                <div class="button-wrapper">
                    <button class="typeBtn" value="allMenu">Все блюда</button>
                    <div class="drop-button">
                        <button id="rolls" class="typeBtn" value="allRolls">Роллы</button>
                        <div class="drop-button-content">
                            <button class="typeBtn" value="coldRolls">Холодные</button>
                            <button class="typeBtn" value="bakedRolls">Запечённые</button>
                            <button class="typeBtn" value="hotRolls">Горячие</button>
                            <button class="typeBtn" value="sets">Сеты</button>
                        </div>
                    </div>
                    <button class="typeBtn" value="pizza">Пицца</button>
                    <button class="typeBtn" value="shaurma">Шаурма</button>
                    <button class="typeBtn" value="zakus">Закуски</button>
                </div>
                <div class="products-wrapper">
                    <?php
                        $allProducts = $conn->query('SELECT * FROM `product` ORDER BY `typeProd` ASC');
                        foreach ($allProducts as $row) {
                            echo '
                                <div class="product-card" id="'.$row['idProduct'].'">
                                    <div class="card-image">
                                        <img src="'.$row['photo'].'" />
                                    </div>
                                    <div class="info-card-wrapper">
                                        <p class="name-product">'.$row['name'].'</p>
                                        <p class="about-product">
                                            '.$row['aboutProd'].'
                                        </p>
                                        <div class="button-price-card">
                                            <button class="add-to-cart" id="'.$row['idProduct'].'">В корзину</button>
                                            <p>'.$row['price'].' ₽</p>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    ?>
                </div>
            </div>
            <div class="delivery-wrapper" id="delivery">
                <p class="title-delivery">Доставка и оплата</p>
                <div class="steps-wrapper">
                    <div class="step">
                        <p class="num-step st-first">1</p>
                        <div class="content-step odd">
                            <img src="images/cart.png" alt="Корзина" />
                            <p class="title-step">Заказ</p>
                            <p class="text-step">Добавьте блюдо в корзину и совершите заказ указав всю небходимую информацию</p>
                        </div>
                    </div>
                    <div class="steps-dots">
                        <div class="dots-wrapper">
                            <div class="container-dot container-fir">
                                <div></div>
                            </div>
                            <div class="container-dot container-fir">
                                <div></div>
                            </div>
                            <div class="container-dot container-fir">
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <div class="step">
                        <div class="content-step even">
                            <img src="images/check.png" alt="Галочка" />
                            <p class="title-step title-longer">Подтверждение</p>
                            <p class="text-step large-text">Наш оператор позвонит Вам в ближайшие несколько минут после совершения заказа для уточнения и подтверждения деталей заказа</p>
                        </div>
                        <p class="num-step st-second">2</p>
                    </div>
                    <div class="steps-dots">
                        <div class="dots-wrapper">
                            <div class="container-dot container-sec">
                                <div></div>
                            </div>
                            <div class="container-dot container-sec">
                                <div></div>
                            </div>
                            <div class="container-dot container-sec">
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <div class="step">
                        <p class="num-step st-third">3</p>
                        <div class="content-step odd">
                            <img src="images/truck.png" alt="Машина" />
                            <p class="title-step">Доставка</p>
                            <p class="text-step">Наши опытные курьеры осуществлят доставку по городу. Доставка происходит в течении  1 - 2 часов </p>
                        </div>
                    </div>
                    <div class="steps-dots">
                        <div class="dots-wrapper">
                            <div class="container-dot container-fir">
                                <div></div>
                            </div>
                            <div class="container-dot container-fir">
                                <div></div>
                            </div>
                            <div class="container-dot container-fir">
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <div class="step">
                        <div class="content-step even pink">
                            <img src="images/ruble.png" alt="Корзина" />
                            <p class="title-step">Оплата</p>
                            <p class="text-step">Оплатите заказ курьеру, способом который Вы выбирали при совершении заказа</p>
                        </div>
                        <p class="num-step st-fourth">4</p>
                    </div>
                </div>
            </div>
            <div class="review-wrapper" id="reviews">
                <div class="title-review">
                    <p>Отзывы</p>
                    <img src="images/line2.png" alt="Палочка" />
                </div>
                <div class="chek-rev">
                    <button class="chek">Посмотреть все отзывы</button>
                </div>
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php
                            $allReviews = $conn->query('SELECT count(*) FROM `review`');

                            $allReviews = $allReviews->fetchAll();

                            $amountSlide = $allReviews[0][0]/3;

                            $amountSlide = ceil($amountSlide);

                            $reviews = $conn->query('SELECT * FROM `review` ORDER BY `createDate` DESC LIMIT 3');
                            
                            $slide = 0;
                            for ($a=0; $a<$amountSlide; $a++) {
                                echo '<div class="swiper-slide">';
                                    foreach ($reviews as $row) {
                                        $rate = array();
                                        $div = '<img src="images/star.png" alt="Оценка" />';
        
                                        
            
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
                                                            <img src="'.$row['image'].'" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stars-wrapper">
                                                    '.$printRate.'
                                                </div>
                                                <p class="review-comment">
                                                    '.$row['comment'].'
                                                </p>
                                            </div> ';
                                    }
                                echo '</div>';
                                $slide = $slide + 3;
                                $reviews = $conn->query('SELECT * FROM `review` ORDER BY `createDate` DESC LIMIT 3 OFFSET '.$slide.'');
                            }
                        ?>   
                    </div>
                    <div class="swiper-button-next sbn-black"></div>
                    <div class="swiper-button-prev sbp-black"></div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="wrapper-footer">
            <div class="contact-footer">
                <p class="title-contact-footer">Контакты</p>
                <hr />
                <p class="contact-phones">+7 (905)961-42-22</p>
                <!-- <p class="contact-phones">Email: example@gmail.com</p> -->
                <div class="social">
                    <a href="https://vk.com/sakurabar42">
                        <i class="fa-brands fa-vk"></i>
                    </a>
                    <a href="https://t.me/Sakura42" target="_blank">
                        <i class="fa-brands fa-telegram"></i>
                    </a>
                </div>
                <div class="about-ip">
                    <p>ИП Нуриев Зияфат Техраб Оглы</p>
                    <p>ОГРНИП: 324420500081990</p>
                    <p>ИНН: 054406607765</p>
                </div>
            </div>
            <div class="contact-footer">
                <p class="title-contact-footer">Адрес</p>
                <hr />
                <p class="contact-phones">Новокузнецк, ул. Ленина, д. 87</p>
            </div>
            <div class="contact-footer map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1213.252173703497!2d87.21433474504356!3d53.781896340822975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x42d0c38fecf328c1%3A0xf1b571d8c6fe2d06!2z0YPQuy4g0JvQtdC90LjQvdCwLCA4Nywg0J3QvtCy0L7QutGD0LfQvdC10YbQuiwg0JrQtdC80LXRgNC-0LLRgdC60LDRjyDQvtCx0LsuLCA2NTQwMzQ!5e0!3m2!1sru!2sru!4v1725977927731!5m2!1sru!2sru" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="create-by">
                    <p>Create by Sorokin Dmitry</p>
                    <img src="images/createby.png" alt="Sorokin D. E." />
                </div>
            </div>
        </div>
    </footer>
</body>
<script src="js/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper('.swiper', {
      slidesPerView: 1,
      direction: getDirection(),
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      on: {
        resize: function () {
          swiper.changeDirection(getDirection());
        },
      },
    });

    function getDirection() {
      var windowWidth = window.innerWidth;
      var direction = window.innerWidth <= 1000 ? 'vertical' : 'horizontal';

      return direction;
    }
</script>
<script type="text/javascript" src="js/header.js"></script>
<script type="text/javascript" src="js/logo.js"></script>
<script type="text/javascript" src="js/movebackground.js"></script>
<script type="text/javascript" src="js/ajax/opencard.js"></script>
<script type="text/javascript" src="js/ajax/takeTypeProd.js"></script>
<script type="text/javascript" src="js/cart.js"></script>
<script type="text/javascript" src="js/chekReview.js"></script>
</html>