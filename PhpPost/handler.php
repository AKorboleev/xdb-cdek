<?php

require '../vendor/autoload.php';

use GuzzleHttp\Client;



// Запрос токена
//-------------------------------------------------------------------
    $client = new Client();
    $url = 'https://api.edu.cdek.ru/v2/oauth/token?grant_type=client_credentials&client_id=EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI&client_secret=PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG';

    $response = $client->request('POST', $url, [
        'header' => ['Content-type' => 'application/x-www-form-urlencoded',]
    ]);
    $data = json_decode($response->getBody()->getContents()); // запрос форматируется в json формат

    // Сам токен
    $token = $data->access_token;
//-------------------------------------------------------------------



// Отправляем запрос на выдачю какого либо товара
//-------------------------------------------------------------------
function curlPostRequest($token, $post, $curUrl)
{

    $ch = curl_init(); //Инициализирует сеанс cURL
    // curl_setopt устанавливает параметры curl
    curl_setopt($ch, CURLOPT_URL, $curUrl);// что будем загружать
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // для возврата результата передачи в качестве строки, место прямого вывода в браузер.
    curl_setopt($ch, CURLOPT_POST, 1); // post запрос
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Передача разных типов данных
    $headers[] = 'Authorization: Bearer ' . $token;
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // выполение запроса

    // Проверка на ошибки
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }else {
        $response = curl_exec($ch); // ответ
        print_r($response);
    }

}
//-------------------------------------------------------------------



// пердеаем токен, json, ссылку
//-------------------------------------------------------------------
curlPostRequest($token,
    '{
    "type": 1,
    "date": "2020-11-03T11:49:32+0700",
    "currency": 1,
    "lang": "rus",
    "from_location": {
        "code": 270
    },
    "to_location": {
        "code": 44
    },
    "packages": [
        {
            "height": 10,
            "length": 10,
            "weight": 4000,
            "width": 10
        }
    ]
}',
    'https://api.edu.cdek.ru/v2/calculator/tarifflist?='
);

//-------------------------------------------------------------------



// Вывод данных
//-------------------------------------------------------------------
function tt($data)
{
    echo '<pre>';
    echo print_r($data);
    echo '</pre>';
}
//-------------------------------------------------------------------

