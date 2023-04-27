<?php
//-------------------------------------------------------------------
// Запрос токена

// curl

//    $url = 'https://api.edu.cdek.ru/v2/oauth/token?grant_type=client_credentials&client_id=EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI&client_secret=PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG';
//    $myCurl = curl_init();
//    curl_setopt_array($myCurl, array(
//        CURLOPT_URL => $url,
//        CURLOPT_RETURNTRANSFER => true,
//        CURLOPT_POST => true,
//        CURLOPT_POSTFIELDS => http_build_query(array(/*здесь массив параметров запроса*/))
//    ));
//    $response = curl_exec($myCurl);
//    $data = json_decode($response);
//    curl_close($myCurl);
//    $token = $data->access_token;
//    print_r($token);

////    echo "Ответ на Ваш запрос: ".$response;

// file_get_contents

    $opts = array('http' =>

        array(

            'method'  => 'POST',

            'header'  => "Content-Type: application/x-www-form-urlencoded",

            'timeout' => 60

        )

    );

    $context  = stream_context_create($opts);

    $url = 'https://api.edu.cdek.ru/v2/oauth/token?grant_type=client_credentials&client_id=EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI&client_secret=PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG';

    $result = file_get_contents($url, false, $context);

    $data = json_decode($result);

    $token = $data->access_token;



//-------------------------------------------------------------------
    // Возможные города доставки
    function curlGetRequest($token, $curUrl)
    {
        // Инициализирует сеанс cURL
        $ch = curl_init();
        // curl_setopt устанавливает параметры curl
        // Что будем загружать
        curl_setopt($ch, CURLOPT_URL, $curUrl);
        // для возврата результата передачи в качестве строки, место прямого вывода в браузер.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // get запрос
        curl_setopt($ch, CURLOPT_POST, 0);
        $headers[] = 'Authorization: Bearer ' . $token;
        $headers[] = 'Content-Type: application/json';
        // выполение запроса
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Проверка на ошибки
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }else {
            $response = curl_exec($ch); // ответ
            print_r($response);
        }
    }
    //-------------------------------------------------------------------

    curlGetRequest($token, 'https://api.cdek.ru/v2/location/cities/?size=3&page=0');

    //-------------------------------------------------------------------
    // Отображение возможной доставки
    function curlPostRequest($token, $post, $curUrl)
    {
        // Инициализирует сеанс cURL
        $ch = curl_init();
        // curl_setopt устанавливает параметры curl
        // что будем загружать
        curl_setopt($ch, CURLOPT_URL, $curUrl);
        // для возврата результата передачи в качестве строки, место прямого вывода в браузер.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post запрос
        curl_setopt($ch, CURLOPT_POST, 1);
        // Передача разных типов данных
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $headers[] = 'Authorization: Bearer ' . $token;
        $headers[] = 'Content-Type: application/json';
        // Выполение запроса
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Проверка на ошибки
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);

        } else {
            // Возращаем
            $response = curl_exec($ch);
            print_r($response);
        }
    }
    //-------------------------------------------------------------------
    // Возможный тариф доставки
    function getSdekTariffs(): string
    {
        $firstCity = 16584;
        $lastCity = 36749;
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
    // Пердеаем токен, json, ссылку
    curlPostRequest($token, getSdektariffs(), 'https://api.edu.cdek.ru/v2/calculator/tarifflist?=');
    //-------------------------------------------------------------------
