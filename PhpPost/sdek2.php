<?php


use CdekSDK\CdekClient;
use GuzzleHttp\Client;

require '../vendor/autoload.php';

    // Указываем имя и пароль
    $account = 'WeW5myxqY83HEjJ7sv8njlGlChbm1ug8';
    $secure = '3rYd7HGWtUkJWWIcQp5zNg2TwaeeXFXh';
// Теперь мы создаем клиента
    $cdek_client = new CdekClient($account, $secure);

//     Принимаем данные в формате json и выводим в объект
    $json = json_decode(file_get_contents('php://input'));

    // Имя тарифа
    $tariffName = $json->tariffName;
    // Сумма доставки
    $deliverySum = $json->deliverySum;
    // минимальное время доставки
    $calendarMin = $json->calendarMin;
    // Максимальное время доставки
    $calendarMax = $json->calendarMax;


$client = new CdekClient($account, $secure, new Client([
    'base_uri' => 'https://integration.cdek.ru',
]));

$response = $client->sendSomeRequest($request);

if ($response->hasErrors()) {
    // Обрабатываем ошибки
    foreach ($response->getMessages() as $message) {
        if ($message->getErrorCode() !== '') {
            // Это ошибка; бывают случаи когда сообщение с ошибкой - пустая строка.
            // Потому нужно смотреть и на код, и на описание ошибки.
            $message->getErrorCode();
            $message->getMessage();
        }
    }
}

