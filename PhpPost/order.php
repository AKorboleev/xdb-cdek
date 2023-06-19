<?php

require_once '../vendor/autoload.php';
// Указываем имя и пароль
use CdekSDK\CdekClient;
use CdekSDK\Common;
use CdekSDK\Common\Order;
use CdekSDK\Requests;
use Mosquitto\Client;

$account = 'WeW5myxqY83HEjJ7sv8njlGlChbm1ug8';
$secure = '3rYd7HGWtUkJWWIcQp5zNg2TwaeeXFXh';
// Теперь мы создаем клиента
$cdek_client = new CdekClient($account, $secure);

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


$client = new CdekClient($account, $secure, new \GuzzleHttp\Client([
    'base_uri' => 'https://integration.cdek.ru',
]));

$order = new Common\Order([
    'Number'   => 'TEST-123456',
    'SendCityCode'    => 44, // Москва
    'RecCityPostCode' => '630001', // Новосибирск
    'RecipientName'  => 'Иван Петров',
    'RecipientEmail' => 'petrov@test.ru',
    'Phone'          => '+7 (383) 202-22-50',
    'TariffTypeCode' => 139, // Посылка дверь-дверь от ИМ
]);

$order->setAddress(Common\Address::create([
    'Street' => 'Холодильная улица',
    'House'  => '16',
    'Flat'   => '22',
]));

$package = Common\Package::create([
    'Number'  => 'TEST-123456',
    'BarCode' => 'TEST-123456',
    'Weight'  => 500, // Общий вес (в граммах)
    'SizeA'   => 10, // Длина (в сантиметрах), в пределах от 1 до 1500
    'SizeB'   => 10,
    'SizeC'   => 10,
]);

$package->addItem(new Common\Item([
    'WareKey' => 'NN0001', // Идентификатор/артикул товара/вложения
    'Cost'    => 500, // Объявленная стоимость товара (за единицу товара)
    'Payment' => 0, // Оплата за товар при получении (за единицу товара)
    'Weight'  => 120, // Вес (за единицу товара, в граммах)
    'Amount'  => 2, // Количество единиц одноименного товара (в штуках)
    'Comment' => 'Test item',
]));

$order->addPackage($package);

$request = new Requests\DeliveryRequest([
    'Number' => 'TESTING123',
]);
$request->addOrder($order);
print_r($order);
$response = $client->sendDeliveryRequest($request);


if ($response->hasErrors()) {
    // обработка ошибок

    foreach ($response->getErrors() as $order) {
        // заказы с ошибками
        $order->getMessage();
        $order->getErrorCode();
        $order->getNumber();
    }

    foreach ($response->getMessages() as $message) {
        // Сообщения об ошибках
    }
}
print_r($client->getNumber());
foreach ($response->getOrders() as $order) {
    // сверяем данные заказа, записываем номер
    $order->getNumber();
    $order->getDispatchNumber();
    break;
}

print_r($response);