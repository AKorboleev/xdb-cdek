<?php

require '../vendor/autoload.php';

use GuzzleHttp\Client;



// получаем данные и отправляем в sdek2.0
//-------------------------------------------------------------------
//function postSdek()
//{
//    // Принимаем данные в формате json и выводим в объект
//    $json = json_decode(file_get_contents('php://input'));
//
////    $tariffName = $json->tariffName;
////    $deliverySum = $json->deliverySum;
////    $calendarMin = $json->calendarMin;
////    $calendarMax = $json->calendarMax;
//
//    $tariffName = 'tariffName';
//    $deliverySum = 'deliverySum';
//    $calendarMin = 'calendarMin';
//    $calendarMax = 'calendarMax';
//
//    print_r($tariffName);
//    print_r($deliverySum);
//    print_r($calendarMin);
//    print_r($calendarMax);
//
//    $client = new Client();
//    $url = 'http://xdb-cdek/PhpPost/sdek2.php';
//
//    try {
//        $response = $client->request('POST', $url, [
//            'header' => [
//                'Content-type' => 'application/x-www-form-urlencoded'
//            ],
//            'form_params' => [
//                'tariffName' => $tariffName,
//                'deliverySum' => $deliverySum,
//                'calendarMin' => $calendarMin,
//                'calendarMax' => $calendarMax,
//
//            ]
//        ]);
//        print_r('good'); //до сюда доходит запрос
//    } catch (\GuzzleHttp\Exception\GuzzleException $e) {
//        $response = $e->getResponse();
//        $responseBodyAsString = $response->getBody()->getContents();
//        print_r($responseBodyAsString);
//    }
//    var_dump($response);
//
//    $data = json_decode($response->getBody()->getContents()); // запрос форматируется в json формат
//    print_r($data);
//
//}
//
////-------------------------------------------------------------------
//
//postsdek();


// получаем данные и отправляем в sdek2.0
//-------------------------------------------------------------------

function cUrl () {

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'http://xdb-cdek/PhpPost/sdek2.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    $post = array(
        'tariffName' => '\"doctor\"',
        'deliverySum' => '\"10000\"',
        'calendarMin' => '\"7\"',
        'calendarMax' => '\"16\"'
    );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    $headers = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    $headers[] = 'Authorization: Bearer eyJzY29wZSI6WyJvcmRlcjphbGwiLCJwYXltZW50OmFsbCJdLCJleHAiOjE2ODEyNzk2NjEsImF1dGhvcml0aWVzIjpbInNoYXJkLWlkOnJ1LTAxIiwiY2xpZW50LWNpdHk60J3QvtCy0L7RgdC40LHQuNGA0YHQuiwg0J3QvtCy0L7RgdC40LHQuNGA0YHQutCw0Y8g0L7QsdC70LDRgdGC0YwiLCJhY2NvdW50LWxhbmc6cnVzIiwiY29udHJhY3Q60JjQnC3QoNCkLdCT0JvQky0yMiIsImFwaS12ZXJzaW9uOjEuMSIsImFjY291bnQtdXVpZDplOTI1YmQwZi0wNWE2LTRjNTYtYjczNy00Yjk5YzE0ZjY2OWEiLCJjbGllbnQtaWQtZWM1OmVkNzVlY2Y0LTMwZWQtNDE1My1hZmU5LWViODBiYjUxMmYyMiIsImNsaWVudC1pZC1lYzQ6MTQzNDgyMzEiLCJzb2xpZC1hZGRyZXNzOmZhbHNlIiwiY29udHJhZ2VudC11dWlkOmVkNzVlY2Y0LTMwZWQtNDE1My1hZmU5LWViODBiYjUxMmYyMiIsImZ1bGwtbmFtZTrQotC10YHRgtC40YDQvtCy0LDQvdC40LUg0JjQvdGC0LXQs9GA0LDRhtC40Lgg0JjQnCJdLCJqdGkiOiJmNGI5YTMzZi04N2Q1LTRhYzgtOGIxMC02M2ZkYTEzNTJhOTAiLCJjbGllbnRfaWQiOiJFTXNjZDZyOUpuRmlRM2JMb3lqSlk2ZU03OEpySmNlSSJ9.AmL7-4rZqCOw8GjzFyioODHRjAkqb4iOv-fkh8x7SkuzYIi6PSHXLXm2h17hMTN0bmY-saOK4ZaJpNFW30Qu_f7hip0FWHDPdKD54tl1hkwNj0fpcgpI79oCkeE65CRzTNa17JqXWVoulGyYW5_g8xJi-p7R2m8k05OerJqVfpHjGovYCQDSfhVmchGQLIX7hIbQJ5qWdt-Py_z1WLMsfEKphEvQdNHBx3FZplYPHwShNX47kkzEFGsYiycDZ4hJbLbbFDEELkKFB-fSefceBXxJ58iUZGYi_DuzhqD6fGFrZmIz8hvKrNBESixDF8FuCpGcbOgXf_E03RXMMmHSgw1';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
}

//-------------------------------------------------------------------
cUrl();