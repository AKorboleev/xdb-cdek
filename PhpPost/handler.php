<?php
//echo getcwd();
require_once '../Controllers/connectionSdek/connectionSdek.php';

// Логин
$account = '';
// Пароль
$password = '';

// Конект с запросами
$connect = new connectionSdek($account, $password);
// Создаем заказ
$body_delivery =  $connect->bodyDelivery(119,
    'шаурма',
    'Игорь Матвеенко ',
    '79230455501',
    'Брокер',
    'Жана Елкова',
    '70239984366',
    'RU',
    'Москва',
    'Москва',
    'Москва',
    '44',
    'пр. Ленинградский, д.4',
    'bar-001',
    '500',
    10,
    10,
    10,
    'Ленейка',
);

// Запрашиваем метод для отправки данных на создания заказа и возращение полученных данных
//$connect->curlPostRequestDelivery($body_delivery);

// Тут идет обращение к успешно выполненному заказу по cdek_number, узнаем его статус
// $connect->statusDelivery('1441337326');

$delivery = $connect->getSdekTariffs(1, 144, 70);

$connect->curlPostTarifs($delivery);

//cdek_number":"1441337326"
//"state":"SUCCESSFUL








// Этот код пригодится, но не помню для чего


//     Принимаем данные в формате json и выводим в объект
$json = json_decode(file_get_contents('php://input'));
//// Имя тарифа
//$tariffName = $json->tariffName;
//// Сумма доставки
//$deliverySum = $json->deliverySum;
//// минимальное время доставки
//$calendarMin = $json->calendarMin;
//// Максимальное время доставки
//$calendarMax = $json->calendarMax;
