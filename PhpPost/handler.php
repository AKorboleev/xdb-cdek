<?php
//-------------------------------------------------------------------
// Запрос токена

// curl

    $url = 'https://api.cdek.ru/v2/oauth/token?grant_type=client_credentials&client_id=WeW5myxqY83HEjJ7sv8njlGlChbm1ug8&client_secret=3rYd7HGWtUkJWWIcQp5zNg2TwaeeXFXh';
    $myCurl = curl_init();
    curl_setopt_array($myCurl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query(array(/*здесь массив параметров запроса*/))
    ));
    $response = curl_exec($myCurl);
    $data = json_decode($response);
    curl_close($myCurl);

    $token = $data->access_token;

//    print_r( "Ответ на Ваш запрос: ".$response);

// file_get_contents

    $opts = array('http' =>

        array(

            'method'  => 'POST',

            'header'  => "Content-Type: application/x-www-form-urlencoded",

            'timeout' => 60

        )

    );

    $context  = stream_context_create($opts);

    $url = 'https://api.cdek.ru/v2/oauth/token?grant_type=client_credentials&client_id=WeW5myxqY83HEjJ7sv8njlGlChbm1ug8&client_secret=3rYd7HGWtUkJWWIcQp5zNg2TwaeeXFXh';

    // Отправляем запрос по указанному url
    $result = file_get_contents($url, false, $context);
    $data = json_decode($result);


    $token = $data->access_token;


//-------------------------------------------------------------------
    // Запрос на все случаи
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
    // Запрос на возможные города доставки
//   curlGetRequest($token, 'https://api.cdek.ru/v2/location/cities/?size=3&page=0');
    // Весь возможный список населенных пунктов.
//   curlGetRequest($token, 'https://api.cdek.ru/v2/location/cities/?');


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
//            print_r($response);

        }
    }
    //-------------------------------------------------------------------
    // Отображение возможной доставки
    function curlPostRequestInfoDelivery($token, $post, $curUrl)
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
            $post = json_decode($response, true);
            $uuid = $post["entity"]["uuid"];
//            print_r($uuid);
//            print_r($post);
            curlGetRequest($token, "https://api.cdek.ru/v2/orders/$uuid");
        }
    }
    //-------------------------------------------------------------------
    // Возможный тариф доставки
    function postSdekTariffs(): string
    {
        $firstCity = 270;
        $lastCity = 40;
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

    function registerOrder ()
    {
        $post = '{
            "number" : "ddOererre7450813980068",
            "comment" : "Новый заказ",
            "delivery_recipient_cost" : {
                "value" : 50
            },
            "delivery_recipient_cost_adv" : [ {
                "sum" : 3000,
                "threshold" : 200
            } ],
            "from_location" : {
                "code" : "44",
                "fias_guid" : "",
                "postal_code" : "",
                "longitude" : "",
                "latitude" : "",
                "country_code" : "",
                "region" : "",
                "sub_region" : "",
                "city" : "Москва",
                "kladr_code" : "",
                "address" : "пр. Ленинградский, д.4"
            },
            "to_location" : {
                "code" : "270",
                "fias_guid" : "",
                "postal_code" : "",
                "longitude" : "",
                "latitude" : "",
                "country_code" : "",
                "region" : "",
                "sub_region" : "",
                "city" : "Новосибирск",
                "kladr_code" : "",
                "address" : "ул. Блюхера, 32"
            },
            "packages" : [ {
                "number" : "bar-001",
                "comment" : "Упаковка",
                "height" : 10,
                "items" : [ {
                    "ware_key" : "00055",
                    "payment" : {
                        "value" : 0
                    },
                    "name" : "Кружка",
                    "cost" : 300,
                    "amount" : 1,
                    "weight" : 500,
                    "url" : "www.item.ru"
                } ],
            "length" : 10,
            "weight" : 500,
            "width" : 10
            } ],
            "recipient" : {
                "name" : "Иванов Иван",
                "phones" : [ {
                "number" : "+79134637228"
            } ]
            },
            "sender" : {
                "name" : "Петров Петр"
            },
            "services" : [ {
                "code" : "INSURANCE"
            } ],
            "tariff_code" : 139
        }';
         return $post;
    }

    function registerOrderDelivery() : string
    {
        $post = '{
        "type": 2,
        "tariff_code": 119,
        "comment": "Новый заказ",
        "shipment_point": "MSK67",
        "sender": {
            "company": "Компания",
            "name": "Петров Петр",
            "email": "msk@cdek.ru",
            "phones": [
                {
                    "number": "+79134000101"
                }
            ]
        },
        "recipient": {
            "company": "Иванов Иван",
            "name": "Иванов Иван",
            "passport_series": "5008",
            "passport_number": "345123",
            "passport_date_of_issue": "2019-03-12",
            "passport_organization": "ОВД Москвы",
            "tin": "123546789",
            "email": "email@gmail.com",
            "phones": [
                {
                    "number": "+79134000404"
                }
            ]
        },
        "to_location": {
            "code": "44",
            "fias_guid": "0c5b2444-70a0-4932-980c-b4dc0d3f02b5",
            "postal_code": "109004",
            "longitude": 37.6204,
            "latitude": 55.754,
            "country_code": "RU",
            "region": "Москва",
            "sub_region": "Москва",
            "city": "Москва",
            "kladr_code": "7700000000000",
            "address": "ул. Блюхера, 32"
        },
        "services": [
            {
                "code": "INSURANCE",
                "parameter": "3000"
            }
        ],
        "packages": [
            {
                "number": "bar-001",
                "weight": "500",
                "length": 10,
                "width": 10,
                "height": 10,
                "comment": " Кружка"
            }
        ]
    }';
        return $post;
    }


    //-------------------------------------------------------------------
    // Пердеаем токен, json, ссылку
//    curlGetRequestInfoDelivery($token, "https://api.cdek.ru/v2/orders/$uuid");
//    curlGetRequest($token,'http://api.cdek.ru/v2/delivery/72753034-90df-4e44-8e50-1fcf67a80ad2');

    // Регистрация товара и информация
curlPostRequestInfoDelivery($token, registerOrderDelivery(), 'https://api.cdek.ru/v2/orders?=');

//    // Данные товара или о товаре
//a38df5c4-ba2d-44fe-9b19-7a501301c915
//    curlGetRequest($token, 'https://api.cdek.ru/v2/orders/a38df5c4-ba2d-44fe-9b19-7a501301c915');
    // Вывод допустимых доставок
//    curlPostRequest($token,  getSdekTariffs(), 'https://api.cdek.ru/v2/calculator/tarifflist?=');
    //-------------------------------------------------------------------
