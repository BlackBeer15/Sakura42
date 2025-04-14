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
    <script src="js/jquery.suggestions.min.js"></script>
    <link href="styles/suggestions.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles/origin.css" />
    <link rel="stylesheet" href="styles/header.css" />
    <link rel="stylesheet" href="styles/cart.css" />
    <link rel="stylesheet" href="styles/footer.css" />
    <link rel="stylesheet" href="styles/media/mediaHeader.css" />
    <link rel="stylesheet" href="styles/media/mediaCart.css" />
    <link rel="stylesheet" href="styles/media/mediaFooter.css" />
    <link href="fontawesome/css/all.min.css" rel="stylesheet" />
    <title>Корзина. Сакура - доставка еды в Новокузнецке</title>
</head>
<body>
    <div class="alert-wrapper">
        <div class="window-alert">
            <i class="fa-solid fa-xmark"></i>
            <p class="error-send"></p>
        </div>
    </div>
    <header>
        <i class="fa-solid fa-cart-shopping">
            <a href="cart.php" onclick="window.scrollTo(0,0);"></a>
            <div class="amount-prod">1</div>
        </i>
        <div class="container">
            <div class="navbar__wrap">
                <a href="https://sakura42.ru" class="logo">
                    <img src="images/logo.png" alt="Логотип - Сакура" />
                </a>
                <ul class="menu" id="menu">
                    <li>
                        <a href="index#menus">Меню</a> 
                    </li>
                    <li>
                        <a href="index#delivery">Доставка</a>
                    </li>
                    <li>
                        <a href="index#reviews">Отзывы</a> 
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
        <div class="bg-cart"></div>
        <div class="wrapper-cart">
            <div class="basic-info-cart">
                <div class="in-cart">
                    <div class="wrapper-title">
                        <p class="title-in-cart">Корзина</p>
                        <img src="images/line.png" alt="Палочка" class="stick"/>
                    </div>
                    <div class="empty-box">Пусто :(</div>
                    <div class="content-cart">
                        
                    </div>
                </div>
                <form class="set-order">
                    <div class="wrapper-title-order">
                        <p class="title-in-order">Оформление заказа</p>
                    </div>
                    <div class="user-info">
                        <p class="title-user-info">Личная информация</p>
                        <div class="wrapper-input">
                            <div>
                                <p>Имя*</p>
                                <input type="text" name="nameUser" required />
                            </div>
                            <div>
                                <p>Номер телефона*</p>
                                <input type="tel" data-phone-pattern placeholder="+7 (___) ___ ____" name="phone" required />
                            </div>
                        </div>
                        <p class="title-typeDeliv">Способ получения</p>
                        <select name="typeDelivery" class="typeDelivery">   
                            <option value="Доставка">Привезите</option>
                            <option value="Самовывоз">Заберу самостоятельно</option>
                        </select>
                        <div class="address-wrapper">
                            <input class="hide-inp" id="settlement" name="settlement" type="text" />
                            <div class="street-div">
                                <p class="street-p">Улица*</p>
                                <input class="street" type="text" name="street" id="street" required />
                            </div>
                            <div class="other-address">
                                <div class="row">
                                    <div class="other-div" >
                                        <p class="other-p">Дом*</p>
                                        <input class="other" type="text" name="home" id="house" required/>
                                    </div>
                                    <div class="other-div">
                                        <p class="other-p">Корпус</p>
                                        <input class="other" type="number" name="korpus"/>
                                    </div>
                                    <div class="other-div">
                                        <p class="other-p">Подъезд</p>
                                        <input class="other" type="number" name="entrance"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="other-div">
                                        <p class="other-p">Этаж</p>
                                        <input class="other" type="number" name="floor"/>
                                    </div>
                                    <div class="other-div">
                                        <p class="other-p">Квартира</p>
                                        <input class="other" type="number" name="appartament"/>
                                    </div>
                                    <div class="other-div">
                                        <p class="other-p">Домофон</p>
                                        <input class="other" type="text" name="homePhone"/>
                                    </div>
                                </div>
                            </div>
                            <p class="title-typeDeliv">Способ оплаты</p>
                            <select name="typePayment" class="typeDelivery">   
                                <option value="Картой курьеру">Картой курьеру</option>
                                <option value="Наличными">Наличными курьеру</option>
                            </select>
                        </div>
                        <div class="cook-to-time">
                            <div>
                                <p>Приготовить к:</p>
                                <input type="datetime-local" name="cookTime" class="date-time" />
                            </div>
                            <div class="point-wrapper">
                                <p class="point-address">Новокузнецк, ул. Ленина, д. 87</p>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1213.252173703497!2d87.21433474504356!3d53.781896340822975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x42d0c38fecf328c1%3A0xf1b571d8c6fe2d06!2z0YPQuy4g0JvQtdC90LjQvdCwLCA4Nywg0J3QvtCy0L7QutGD0LfQvdC10YbQuiwg0JrQtdC80LXRgNC-0LLRgdC60LDRjyDQvtCx0LsuLCA2NTQwMzQ!5e0!3m2!1sru!2sru!4v1725977927731!5m2!1sru!2sru" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="total-price">
                        <div>
                            <p class="order-price">Сумма заказа: <span class="price">0</span> ₽</p>
                            <p class="order-price">Стоимость доставки: <span class="delivery-price">0</span> ₽</p>
                            <p class="final-price"><span>Итого: </span><span class="price new-price">0</span> ₽</p>
                        </div>
                        <input type="submit" name="send-chek" class="send-chek" value="Заказать" />
                    </div>
                </form>
            </div>
            <div class="delivery-info">
                <div class="title-delivery-info">
                    <p>Стоимость доставки</p>
                </div>
                <table>
                    <tr>
                        <th></th>
                        <th>Кузнецкий район</th>
                        <th>Центральный район</th>
                        <th>Орджоникидзевский район</th>
                        <th>Заводской район</th>
                        <th>Новоильинский район</th>
                    </tr>
                    <tr>
                        <th>Сумма заказа менее 800 ₽</th>
                        <td>150 ₽</td>
                        <td>200 ₽</td>
                        <td>250 ₽</td>
                        <td>250 ₽</td>
                        <td>350 ₽</td>
                    </tr>
                    <tr>
                        <th>Сумма заказа более 800 ₽</th>
                        <td rowspan="5">Бесплатно</td>
                        <td>200 ₽</td>
                        <td>250 ₽</td>
                        <td>250 ₽</td>
                        <td>350 ₽</td>
                    </tr>
                    <tr>
                        <th>Сумма заказа более 1700 ₽</th>
                        <td rowspan="4">Бесплатно</td>
                        <td>250 ₽</td>
                        <td>250 ₽</td>
                        <td>350 ₽</td>
                    </tr>
                    <tr>
                        <th>Сумма заказа более 1800 ₽</th>
                        <td rowspan="3">Бесплатно</td>
                        <td>250 ₽</td>
                        <td>350 ₽</td>
                    </tr>
                    <tr>
                        <th>Сумма заказа более 2000 ₽</th>
                        <td colspan="2">Бесплатно</td>
                    </tr>
                </table>
            </div>
        </div>
    </main>
    <footer>
        <div class="wrapper-footer">
            <div class="contact-footer">
                <p class="title-contact-footer">Контакты</p>
                <hr />
                <p class="contact-phones">+7(905) 961-42-22</p>
                <!-- <p class="contact-phones">Email: example@gmail.com</p> -->
                <div class="social">
                    <a href="https://vk.com/sakurabar42">
                        <i class="fa-brands fa-vk"></i>
                    </a>
                    <a href="https://t.me/Sakura42">
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
<script type="text/javascript" src="js/header.js"></script>
<script type="text/javascript" src="js/logo.js"></script>
<script type="text/javascript" src="js/phonepattern.js"></script>
<script type="text/javascript" src="js/typedelivery.js"></script>
<script type="text/javascript" src="js/cart.js"></script>
<script type="text/javascript" src="js/ajax/getProductCart.js"></script>
<script type="text/javascript" src="js/ajax/sendOrder.js"></script>
<script>
    $("#address").suggestions({
        token: "75dc07d57cefbef4e4d7c2386f3ff84ca3a0cb37",
        type: "ADDRESS",
        
        onSelect: function(suggestion) {
            console.log(suggestion);
        }
    });
</script>
<script type="text/javascript" src="js/suggestions.js"></script>
<script type="text/javascript" src="js/datetime.js"></script>
<script type="text/javascript" src="js/correctPrice.js"></script>
<script type="text/javascript" src="js/notification.js"></script>
</html>