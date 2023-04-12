<?php

require '../vendor/autoload.php';


use GuzzleHttp\Client;

//

// Запрос токена
//-------------------------------------------------------------------

    $client = new Client();
    $url = 'https://api.edu.cdek.ru/v2/oauth/token?grant_type=client_credentials&client_id=EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI&client_secret=PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG';

    $response = $client->request('POST', $url, [
        'header' => ['Content-type' => 'application/x-www-form-urlencoded',]
    ]);
    $data = json_decode($response->getBody()->getContents()); // запрос форматируется в json формат

    //tt($data);
    //Сам токен
    $token = $data->access_token;
//    tt($token);
//-------------------------------------------------------------------




// Отправляем запрос на выдачю какого либо товара
//-------------------------------------------------------------------
function PostRequest($token, $post, $curUrl)
{
    // Не трогать , если $post не будет работать, то поставить эту переменную вместо ее
    //$PostJson = "{\n    \"type\": 1,\n    \"date\": \"2020-11-03T11:49:32+0700\",\n    \"currency\": 1,\n    \"lang\": \"rus\",\n    \"from_location\": {\n        \"code\": 270\n    },\n    \"to_location\": {\n        \"code\": 44\n    },\n    \"packages\": [\n        {\n            \"height\": 10,\n            \"length\": 10,\n            \"weight\": 4000,\n            \"width\": 10\n        }\n    ]\n}";
    //-------------------------------------------------------------------

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $curUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $headers[] = 'Authorization: Bearer ' . $token;
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }else {
        curl_close($ch);
    }
    // response  - в нем находится большой массив tariff_codes, внутри которого еще куча объектов
    $response = curl_exec($ch);
    print_r($response);


}


PostRequest($token,
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


// Вывод данных
//-------------------------------------------------------------------
function tt($data)
{
    echo '<pre>';
    echo print_r($data);
    echo '</pre>';
}
