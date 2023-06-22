<?php

require_once "Controllers/bodyRequest/varyablel_method_delivery/variablesInternetShop.php";

class connectionSdek extends variablesInternetShop
{

    protected string $url;

    protected string $account;

    protected string $password;

    private string $token;

    // Доставка в ней тело запроса
    public string $body_delivery;

    //  интернет-магазин в ней тело запроса
    public string $body_internet_shop;


    //---------------------------------------------------------------------------
    // Конект сдеком
    public function __construct($account, $password)
    {

            //  Url конекта сдека
            $url = "https://api.cdek.ru/v2/oauth/token?grant_type=client_credentials&client_id=$account&client_secret=$password";
            $myCurl = curl_init();
            curl_setopt_array($myCurl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => http_build_query(array(/*здесь массив параметров запроса*/))
            ));
            // Получаем ответ
            $response = curl_exec($myCurl);
            $data = json_decode($response);
            // Массив с хейдера
            $opts = array('http' =>

                array(

                    'method'  => 'POST',

                    'header'  => "Content-Type: application/x-www-form-urlencoded",

                    'timeout' => 60

                )

            );
            $context  = stream_context_create($opts);
            // Отправляем запрос по указанному url
            $result = file_get_contents($url, false, $context);
            // Декодируем json формат
            $data = json_decode($result);
            curl_close($myCurl);
            // Сохраняем токен
            $this->token = $data->access_token;
    }
    //-------------------------------------------------------------------
    // Гет запрос
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
    //---------------------------------------------------------------------------
    // Узнать информацию о заказе
    function curlPostRequestInfoDelivery($post)
    {
        // Инициализирует сеанс cURL
        $ch = curl_init();
        // curl_setopt устанавливает параметры curl
        // что будем загружать
        curl_setopt($ch, CURLOPT_URL, 'https://api.cdek.ru/v2/orders?=');
        // для возврата результата передачи в качестве строки, место прямого вывода в браузер.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post запрос
        curl_setopt($ch, CURLOPT_POST, 1);
        // Передача разных типов данных
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $headers[] = 'Authorization: Bearer ' . $this->token;
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
            print_r($post);
//            $uuid = $post["entity"]["uuid"];

//            curlGetRequest($this->token, "https://api.cdek.ru/v2/orders/$uuid");
        }
    }
    //---------------------------------------------------------------------------
    // Пост заапрос в сдек
    public function curlPostarifs($post)
    {
        // Инициализирует сеанс cURL
        $ch = curl_init();
        // curl_setopt устанавливает параметры curl
        // что будем загружать
        curl_setopt($ch, CURLOPT_URL, 'https://api.cdek.ru/v2/calculator/tarifflist?=');
        // для возврата результата передачи в качестве строки, место прямого вывода в браузер.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post запрос
        curl_setopt($ch, CURLOPT_POST, 1);
        // Передача разных типов данных
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $headers[] = 'Authorization: Bearer ' . $this->token;
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
    // Возможный тариф доставки
    function getSdekTariffs($firstCity, $lastCity, $type)
    {
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
    }
    //---------------------------------------------------------------------------
    // тело запроса доставки
    public function bodyDelivery($tariff_code,$sender_company,$sender_name_last_name_surname,$sender_numbers_phone,$recipient_company, $receiving_numbers_phone , $receiving_name_last_name_surname, $str_address,$region, $cub_region,$city, $code, $address, $number_packages,$all_weights, $length, $width, $height, $comments)
    {
        $this->body_delivery = '{
             "type": 2,
             "tariff_code": '.$this->tariff_code.',
             "comment": "Новый заказ",
             "shipment_point": "MSK67",
             "sender": {
                 "company": "'.$this->sender_company.'",
                 "name": "'.$this->sender_name_last_name_surname.'",
                 "email": "msk@cdek.ru",
                 "phones": [
                     {
                         "number": "+'.$this->receiving_numbers_phone .'"
                     }
                 ]
             },
             "recipient": {
                 "company": "'. $this->recipient_company .'",
                 "name": "'. $this->receiving_name_last_name_surname .'",
                 "passport_series": "5008",
                 "passport_number": "345123",
                 "passport_date_of_issue": "2019-03-12",
                 "passport_organization": "ОВД Москвы",
                 "tin": "123546789",
                 "email": "email@gmail.com",
                 "phones": [
                     {
                         "number": "+'.$this->sender_numbers_phone.'"
                     }
                 ]
             },
             "to_location": {
                 "code": "'.$this->code.'",
                 "fias_guid": "0c5b2444-70a0-4932-980c-b4dc0d3f02b5",
                 "postal_code": "109004",
                 "longitude": 37.6204,
                 "latitude": 55.754,
                 "country_code": "'.$this->str_address.'",
                 "region": "'.$this->region.'",
                 "sub_region": "'.$this->city.'",
                 "city": "Москва",
                 "kladr_code": "7700000000000",
                 "address": "'.$this->address.'"
             },
             "services": [
                 {
                     "code": "INSURANCE",
                     "parameter": "3000"
                 }
             ],
             "packages": [
                 {
                     "number": "'.$this->number_packages.'",
                     "weight": "'.$this->all_weights.'",
                     "length": '.$this->length.',
                     "width": '.$this->width.',
                     "height": '.$this->height.',
                     "comment": "'.$this->comments.'"
                 }
             ]
         }';
    }
    //--------------------------------------------------------------------------
    // тело запроса интернет-магазина
    public function bodyinternetShop ()
    {
        $body_internet_shop = '{
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
        //---------------------------------------------------------------------------
    }

}

