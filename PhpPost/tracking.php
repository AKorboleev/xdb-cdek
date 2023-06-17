<?php

require_once '../vendor/autoload.php';
use CdekSDK\CdekClient;
use CdekSDK\Common;
use CdekSDK\Requests;

$account = 'WeW5myxqY83HEjJ7sv8njlGlChbm1ug8';
$secure = '3rYd7HGWtUkJWWIcQp5zNg2TwaeeXFXh';
// Теперь мы создаем клиента

$cdek_client = new CdekClient($account, $secure);

$client = new CdekClient($account, $secure, new \GuzzleHttp\Client([
    'base_uri' => 'https://integration.cdek.ru',
]));

$dispatchNumber = '12345678910';


$request = new Requests\StatusReportRequest();
// можно указывать или всё сразу, или только диапазоны дат, или только конкретные заказы
$request->setChangePeriod(new Common\ChangePeriod(new \DateTime('-1 day'), new \DateTime('+1 day')));
$request->addOrder(Common\Order::withDispatchNumber($dispatchNumber));

// попросим показать историю изменения статусов заказов
$request->setShowHistory();

$response = $client->sendStatusReportRequest($request);

if ($response->hasErrors()) {
    // обработка ошибок
}

foreach ($response as $order) {
    /** @var \CdekSDK\Common\Order $order */
    $order->getActNumber();
    $order->getNumber();
    $order->getDispatchNumber();
    $order->getDeliveryDate();
    $order->getRecipientName();

    if ($status = $order->getStatus()) {
        $status->getDescription();
        $status->getDate();
        $status->getCode();
        $status->getCityCode();
        $status->getCityName();

        foreach ($status->getStates() as $state) {
            $state->getDescription();
            $state->getDate();
            $state->getCode();
            $state->getCityCode();
            $state->getCityName();
            $state->isFinal();
        }
    }

    $order->getReason()->getCode();
    $order->getReason()->getDescription();
    $order->getReason()->getDate();

    $order->getDelayReason()->getCode();
    $order->getDelayReason()->getDescription();
    $order->getDelayReason()->getDate();
}