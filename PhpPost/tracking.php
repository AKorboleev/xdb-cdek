<?php

require_once '../vendor/autoload.php';
use CdekSDK\CdekClient;
use CdekSDK\Common;
use CdekSDK\Common\Order;
use CdekSDK\Requests;
use GuzzleHttp\Client;

$account = 'WeW5myxqY83HEjJ7sv8njlGlChbm1ug8';
$secure = '3rYd7HGWtUkJWWIcQp5zNg2TwaeeXFXh';
// Теперь мы создаем клиента

$cdek_client = new CdekClient($account, $secure);

//$client = new CdekClient($account, $secure, new Client([
//    'base_uri' => 'https://integration.cdek.ru',
//]));
$client = new \CdekSDK\CdekClient($account, $secure);

$dispatchNumber = '12345678910';

$request = new Requests\StatusReportRequest();
// можно указывать или всё сразу, или только диапазоны дат, или только конкретные заказы
$request->setChangePeriod(new Common\ChangePeriod(new \DateTime('-1 day'), new \DateTime('+1 day')));
$request->addOrder(Order::withDispatchNumber($dispatchNumber));

// попросим показать историю изменения статусов заказов
$request->setShowHistory();

$response = $client->sendStatusReportRequest($request);

if ($response->hasErrors()) {
    // обработка ошибок
}

foreach ($response as $order) {
    /** @var Order $order */
    $order->getNumber();
    $order->getSenderCity()->getName();
    $order->getRecipientCity()->getName();

    foreach ($order->getPackages() as $package) {
        $package->getBarCode();
        $package->getVolumeWeight();
    }

    foreach ($order->getAdditionalServices() as $service) {
        $service->getServiceCode();
        $service->getSum();
    }
}