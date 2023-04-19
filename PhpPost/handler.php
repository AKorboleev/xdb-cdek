<?php

    require '../vendor/autoload.php';

    use GuzzleHttp\Client;




    //-------------------------------------------------------------------
    // Запрос токена
    $client = new Client();
    $url = 'https://api.edu.cdek.ru/v2/oauth/token?grant_type=client_credentials&client_id=EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI&client_secret=PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG';
    $response = $client->request('POST', $url, [
        'header' => [
            'Content-type' => 'application/x-www-form-urlencoded'
            ]
    ]);
    $data = json_decode($response->getBody()->getContents()); // запрос форматируется в json формат

    // Сам токен
    $token = $data->access_token;
    //-------------------------------------------------------------------
    // Возможные города доставки
    function curlGetRequest($token, $curUrl)
    {
        $ch = curl_init(); //Инициализирует сеанс cURL
        // curl_setopt устанавливает параметры curl
        curl_setopt($ch, CURLOPT_URL, $curUrl);// что будем загружать
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // для возврата результата передачи в качестве строки, место прямого вывода в браузер.
        curl_setopt($ch, CURLOPT_POST, 0); // get запрос
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

    //curlGetRequest($token, 'https://api.cdek.ru/v2/location/cities/?size=3&page=0');

    //-------------------------------------------------------------------
    // Отображение возможной доставки
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
    // Доставка
    function getSdekTariffs(): string
    {
        $firstCity = '16584';
        $lastCity = '36749';
        $type = 1;
        $post = '{
            "type":' . $type . ',
            "date": "2020-11-03T11:49:32+0700",
            "currency": 1,
            "lang": "rus",
            "from_location": {
                "code": '. $firstCity .'
            },
            "to_location": {
                "code": '. $lastCity .'
            },
            "packages": [
                {
                    "height": 10,
                    "length": 20,
                    "weight": 4000,
                    "width": 10
                }
            ]
        }';

        return $post;
    }
    //-------------------------------------------------------------------
    // пердеаем токен, json, ссылку
    curlPostRequest($token,
        getSdektariffs(),
        'https://api.edu.cdek.ru/v2/calculator/tarifflist?=',
    );
    //-------------------------------------------------------------------
