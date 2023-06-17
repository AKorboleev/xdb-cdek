<?php

require_once '../vendor/autoload.php';
// Указываем имя и пароль
use CdekSDK\CdekClient;
use CdekSDK\Common;
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
    'Number'     => 'TEST-123456',
    'SendCityCode'    => 44, // Москва
    'RecCityPostCode' => '630001', // Новосибирск
    'RecipientName'    => 'Иван Петров',
    'RecipientEmail'   => 'petrov@test.ru',
    'Phone'            => '+7 (383) 202-22-50',
    'TariffTypeCode'   => 1,
    'RecipientCompany' => 'Петров и партнёры, ООО',
    'Comment'          => 'Это тестовый заказ',
]);

$order->setSender(Common\Sender::create([
    'Company' => 'ЗАО «Рога и Копыта»',
    'Name'    => 'Петр Иванов',
    'Phone'   => '+7 (283) 101-11-20',
])->setAddress(Common\Address::create([
    'Street' => 'Морозильная улица',
    'House'  => '2',
    'Flat'   => '101',
])));

$order->setAddress(Common\Address::create([
    'Street'  => 'Холодильная улица',
    'House'   => '16',
    'Flat'    => '22',
]));

$package = Common\Package::create([
    'Number'  => 'TEST-123456',
    'BarCode' => 'TEST-123456',
    'Weight'  => 500, // Общий вес (в граммах)
    'SizeA'   => 10, // Длина (в сантиметрах), в пределах от 1 до 1500
    'SizeB'   => 10,
    'SizeC'   => 10,
    'Comment' => 'Обязательное описание вложения',
]);

$order->addPackage($package);

$order->addService(Common\AdditionalService::create(Common\AdditionalService::SERVICE_DELIVERY_TO_DOOR));

$request = new Requests\AddDeliveryRequest([
    'Number'          => 'TESTING123',
    'ForeignDelivery' => false,
    'Currency'        => 'RUB',
]);
$request->addOrder($order);

$response = $client->sendAddDeliveryRequest($request);

if ($response->hasErrors()) {
    // обработка ошибок
}

foreach ($response->getOrders() as $order) {
    // сверяем данные заказа, записываем номер
    $order->getNumber();
    $order->getDispatchNumber();
    print_r(
        $order->getNumber()
        ->getdispatchNumber()
    );
}


