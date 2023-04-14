<?php

// получаем данные и отправляем в sdek2.0
//-------------------------------------------------------------------


use GuzzleHttp\Client;

function postSdek()
{
    $json = json_decode(file_get_contents('php://input'));
    $tariffName = $json->tariffName;
    $deliverySum = $json->deliverySum;
    $calendarMin = $json->calendarMin;
    $calendarMax = $json->calendarMax;

    $client = new Client();
    $response = $client->request('POST', 'http://xdb-cdek/sdekTwo/sdek2.php', [
        'header' => [
            'Content-type' => 'application/x-www-form-urlencoded'
        ],
        'form_params' => [
            'tariffName' => $tariffName,
            'deliverySum' => $deliverySum,
            'calendarMin' => $calendarMin,
            'calendarMax' => $calendarMax,

        ]
    ]);

    $data = json_decode($response->getBody()->getContents());
    print_r($data);

}
//-------------------------------------------------------------------

postsdek();
