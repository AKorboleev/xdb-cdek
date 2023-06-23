<?php

require_once "../Controllers/bodyRequest/varyablel_method_delivery/variablesInternetShop.php";

require_once "../Controllers/bodyRequest/varyablel_method_delivery/variables_tariff.php";

class connectionSdek extends variablesInternetShop
{
    // Переменная в которую  передается url
    protected string $url;
    // Имя аккаунта
    protected string $account;
    // Пароль к нему
    protected string $password;
    // Токен
    private string $token;
    // Массив со статусом заказа
    private array $code_status_delivery = [
        'ACCEPTED'=> ['Принят', 'Заказ создан в информационной системе СДЭК, но требуются дополнительные валидации'],
        'CREATED'=> ['Создан',  'Заказ создан в информационной системе СДЭК и прошел необходимые валидации '],
        'RECEIVED_AT_SHIPMENT_WAREHOUSE'=> ['Принят на склад отправителя', 'Оформлен приход на склад СДЭК в городе-отправителе.'],
        'READY_FOR_SHIPMENT_IN_SENDER_CITY'=> ['Выдан на отправку в г. отправителе','Оформлен расход со склада СДЭК в городе-отправителе. Груз подготовлен к отправке (консолидирован с другими посылками)'],
        'RETURNED_TO_SENDER_CITY_WAREHOUSE'=> ['Возвращен на склад отправителя','Повторно оформлен приход в городе-отправителе (не удалось передать перевозчику по какой-либо причине).Примечание: этот статус не означает возврат груза отправителю.'],
        'TAKEN_BY_TRANSPORTER_FROM_SENDER_CITY'=> ['Сдан перевозчику в г. отправителе',  'Заказ создан в информационной системе СДЭК, но требуются дополнительные валидации'],
        'SENT_TO_TRANSIT_CITY'=> ['Отправлен в г. транзит','Зарегистрирована отправка в город-транзит. Проставлены дата и время отправления у перевозчика'],
        'ACCEPTED_IN_TRANSIT_CITY'=> ['Встречен в г. транзите','Зарегистрирована встреча в городе-транзите'],
        'ACCEPTED_AT_TRANSIT_WAREHOUSE'=> ['Принят на склад транзита', 'Оформлен приход в городе-транзите'],
        'RETURNED_TO_TRANSIT_WAREHOUSE'=> ['Возвращен на склад транзита','Оформлен приход на склад СДЭК в городе-отправителе.'],
        'READY_FOR_SHIPMENT_IN_TRANSIT_CITY' => ['Выдан на отправку в г. транзите', 'Оформлен расход в городе-транзите'],
        'TAKEN_BY_TRANSPORTER_FROM_TRANSIT_CITY' => ['Сдан перевозчику в г. транзите','Оформлен расход в городе-транзите'],
        'SENT_TO_SENDER_CITY' => ['Отправлен в г. отправитель', 'Зарегистрирована отправка в город-отправитель, груз в пути'],
        'SENT_TO_RECIPIENT_CITY' => ['Отправлен в г. получатель', 'Зарегистрирована отправка в город-получатель, груз в пути'],
        'ACCEPTED_IN_SENDER_CITY' => ['Встречен в г. отправителе', 'Зарегистрирована встреча груза в городе-отправителе'],
        'ACCEPTED_IN_RECIPIENT_CITY' => ['Встречен в г. получателе','Зарегистрирована встреча груза в городе-получателе'],
        'ACCEPTED_AT_RECIPIENT_CITY_WAREHOUSE' => ['Принят на склад доставки', '	Оформлен приход на склад города-получателя, ожидает доставки до двери'],
        'ACCEPTED_AT_PICK_UP_POINT' => ['Принят на склад до востребования','Оформлен приход на склад города-получателя. Доставка до склада, посылка ожидает забора клиентом - покупателем ИМ'],
        'TAKEN_BY_COURIER' => ['Выдан на доставку','Добавлен в курьерскую карту, выдан курьеру на доставку'],
        'RETURNED_TO_RECIPIENT_CITY_WAREHOUSE' => ['Возвращен на склад доставки', 'Оформлен повторный приход на склад в городе-получателе. Доставка не удалась по какой-либо причине, ожидается очередная попытка доставки. Примечание: этот статус не означает возврат груза отправителю.'],
        'DELIVERED' => ['Вручен', 'Успешно доставлен и вручен адресату (конечный статус).'],
        'NOT_DELIVERED' => ['Не вручен', 'Покупатель отказался от покупки, возврат в ИМ (конечный статус).'],
        'INVALID' => ['Некорректный заказ', 'Заказ содержит некорректные данные'],
        'IN_CUSTOMS_INTERNATIONAL' => ['Таможенное оформление в стране отправления', 'В процессе таможенного оформления в стране отправителя (для международных заказов).'],
        'SHIPPED_TO_DESTINATION' => ['Отправлено в страну назначения', 'Отправлен в страну назначения, заказ в пути (для международных заказов).'],
        'PASSED_TO_TRANSIT_CARRIER'  => ['Передано транзитному перевозчику', 'Передан транзитному перевозчику для доставки в страну назначения (для международных заказов).'],
        'IN_CUSTOMS_LOCAL' => ['Таможенное оформление в стране назначения', 'В процессе таможенного оформления в стране назначения (для международных заказов).'],
        'CUSTOMS_COMPLETE' => ['Таможенное оформление завершено', 'Завершено таможенное оформление заказа (для международных заказов).'],
        'POSTOMAT_POSTED' => ['Заложен в постамат', 'Заложен в постамат, заказ ожидает забора клиентом - покупателем ИМ.'],
        'POSTOMAT_SEIZED' => ['Изъят из постамата курьером', 'Истек срок хранения заказа в постамате, возврат в ИМ.'],
        'POSTOMAT_RECEIVED' => ['Изъят из постамата клиентом','Успешно изъят из постамата клиентом - покупателем ИМ.'],
    ];
    // Доставка в ней тело запроса
    public string $body_delivery;
    //  интернет-магазин в ней тело запроса
    public string $body_internet_shop;
    // Тело запроса тарифа городов
    public string $bodyTariffsCity;

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
    function curlGetRequest($curUrl)
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
        $headers[] = 'Authorization: Bearer ' . $this->token;
        $headers[] = 'Content-Type: application/json';
        // выполение запроса
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Проверка на ошибки
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }else {
            $response = curl_exec($ch); // ответ
            // декодируем пришедший  json
            $post = json_decode($response, true);
            print_r($post);
        }
    }
    //---------------------------------------------------------------------------
    // Метод для отправки данных на создания заказа и возращение полученных данных
    function curlPostRequestDelivery($post)
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
//            var_dump($post);
            $uuid = $post["entity"]["uuid"];
           $this->curlGetRequest( "https://api.cdek.ru/v2/orders/$uuid");
        }
    }
    //---------------------------------------------------------------------------
    // Пост заапрос в сдек
    //---------------------------------------------------------------------------
    // Статус заказа
    public function statusDelivery ($cdek_number) {
        // Инициализирует сеанс cURL
        $ch = curl_init();
        // curl_setopt устанавливает параметры curl
        // Что будем загружать
        curl_setopt($ch, CURLOPT_URL, 'https://api.cdek.ru/v2/orders?cdek_number=' . $cdek_number);
        // для возврата результата передачи в качестве строки, место прямого вывода в браузер.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // get запрос
        curl_setopt($ch, CURLOPT_POST, 0);
        // Настрйока хейдера
        $headers[] = 'Authorization: Bearer ' . $this->token;
        $headers[] = 'Content-Type: application/json';
        // выполение запроса
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Проверка на ошибки
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }else {
            $response = curl_exec($ch); // ответ
            // декодируем пришедший  json
            $post = json_decode($response, true);
//            print_r($post);
            //---------------------------------------------------------------------------
            //Тут идет проверка на целостность запроса. Обработался ли он или нет
            // Если статус заказа инвалид
            if($status = $post["requests"]["0"]["state"] == "INVALID") {
                echo $status;
                echo "запрос обработался с ошибкой";
            }// Если статус заказа ошибка
            else if($status = $post["requests"]["0"]["state"] == "WAITING")
            {
                echo $status;
                echo "запрос ожидает обработки (зависит от выполнения другого запроса)";
            }// Если статус заказа принятый
            else if($status = $post["requests"]["0"]["state"] == "ACCEPTED")
            {
                // Вывод статуса
                echo $status . 'пройдена предварительная валидация и запрос принят';
            }// Если статус заказа успешный, тогда выведится трек номер
            else {
                echo 'SUCCESSFUL <br>';
                // Передаем в переменную трек нормер
                $cdek_number = $post["entity"]["cdek_number"];
                // Выводим его
                echo 'cdek_number'. $cdek_number .'<br>';
                // Передаем в переменную статус заказа
                $status_delivery = $post["entity"]["statuses"]["0"]["code"];
                // Цикл выводит  статус заказа и комментарий к нему
                foreach ((array) $status_delivery as $key) {
                    // Идет сравнение пришедшего статуса и статуса с массива
                    if (is_string($status_delivery) == $this->code_status_delivery[$key])
                    {//Если все хорошо, то он выведет
                        // Статус, комментарий
                        echo $this->code_status_delivery[$key][0], $this->code_status_delivery[$key][1] . '<br>';
                    }
                    else
                    {// Если статус не найдет
                        echo "Статус не найдет <br>";
                    }

                }
                echo 'запрос обработан успешно <br>';
            }
        }
    }
    //-------------------------------------------------------------------
    // Запрос для вывода тарифа доставки по России
    public function curlPostTarifs($post)
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
            print_r($response);

        }
    }
    //-------------------------------------------------------------------
    // Тело тарифа городов
     public function getSdekTariffs($type, $firstCity, $lastCity)
    {
        return  $this->bodyTariffsCity = '{
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
    // Тело  тарифа доставки
    public function bodyDelivery($tariff_code, $sender_company, $sender_name_last_name_surname, $sender_numbers_phone, $recipient_company, $recipient_name_last_name_surname, $recipient_numbers_phone, $str_address, $recipient_region, $recipient_sub_region, $recipient_city, $to_location_code , $sender_address, $number_packages, $all_weights, $length, $width, $height, $comments)
    {
        return $this->body_delivery = '{
             "type": 2,
             "tariff_code": ' . $tariff_code . ',
             "comment": "Новый заказ",
             "shipment_point": "MSK67",
             "sender": {
                 "company": "' . $sender_company . '",
                 "name": "' . $sender_name_last_name_surname . '",
                 "email": "msk@cdek.ru",
                 "phones": [
                     {
                         "number": "+' . $sender_numbers_phone . '"
                     }
                 ]
             },
             "recipient": {
                 "company": "' . $recipient_company . '",
                 "name": "' . $recipient_name_last_name_surname . '",
                 "passport_series": "5008",
                 "passport_number": "345123",
                 "passport_date_of_issue": "2019-03-12",
                 "passport_organization": "ОВД Москвы",
                 "tin": "123546789",
                 "email": "email@gmail.com",
                 "phones": [
                     {
                         "number": "+' . $recipient_numbers_phone . '"
                     }
                 ]
             },
             "to_location": {
                 "code": "' . $to_location_code . '",
                 "fias_guid": "0c5b2444-70a0-4932-980c-b4dc0d3f02b5",
                 "postal_code": "109004",
                 "longitude": 37.6204,
                 "latitude": 55.754,
                 "country_code": "' . $str_address . '",
                 "region": "' . $recipient_region . '",
                 "sub_region": "' . $recipient_sub_region . '",
                 "city": "' . $recipient_city . '",
                 "kladr_code": "7700000000000",
                 "address": "' . $sender_address . '"
             },
             "services": [
                 {
                     "code": "INSURANCE",
                     "parameter": "3000"
                 }
             ],
             "packages": [
                 {
                     "number": "' . $number_packages . '",
                     "weight": "' . $all_weights . '",
                     "length": ' . $length . ',
                     "width": ' . $width . ',
                     "height": ' . $height . ',
                     "comment": "' . $comments . '"
                 }
             ]
         }';
    }
    //--------------------------------------------------------------------------
    // Тело  тарифа интернет-магазина
    public function bodyinternetShop ($sum, $threshold, $from_location_code, $sender_region, $sender_sub_region, $sender_city, $sender_address, $to_location_code, $recipient_region, $recipient_sub_region, $recipient_city, $recipient_address, $number_packages, $packages_comment, $height, $payment_method, $packages_name, $cost, $length, $all_weights, $width, $sender_name_last_name_surname, $sender_numbers_phone, $receiving_name_last_name_surname, $receiving_numbers_phone, $services_code, $tariff_code )
    {
        $body_internet_shop = '{
            "number" : "ddOererre7450813980068",
            "comment" : "Новый заказ",
            "delivery_recipient_cost" : {
                "value" : 50
            },
            "delivery_recipient_cost_adv" : [ {
                "sum" : ' . $sum . ',
                "threshold" : ' . $threshold . '
            } ],
            "from_location" : {
                "code" : "' . $from_location_code . '",
                "fias_guid" : "",
                "postal_code" : "",
                "longitude" : "",
                "latitude" : "",
                "country_code" : "",
                "region" : "' . $sender_region . '",
                "sub_region" : "' . $sender_sub_region . '",
                "city" : "' . $sender_city . '",
                "kladr_code" : "",
                "address" : "' . $sender_address . '"
            },
            "to_location" : {
                "code" : "' . $to_location_code . '",
                "fias_guid" : "",
                "postal_code" : "",
                "longitude" : "",
                "latitude" : "",
                "country_code" : "",
                "region" : "' . $recipient_region . '",
                "sub_region" : "' . $recipient_sub_region . '",
                "city" : "' . $recipient_city . '",
                "kladr_code" : "",
                "address" : "' . $recipient_address . '"
            },
            "packages" : [ {
                "number" : "' . $number_packages . '",
                "comment" : "' . $packages_comment . '",
                "height" : ' . $height .',
                "items" : [ {
                    "ware_key" : "00055",
                    "payment" : {
                        "value" : ' . $payment_method .'
                    },
                    "name" : "' . $packages_name . '",
                    "cost" : ' . $cost .',
                    "amount" : 1,
                    "weight" : 500,
                    "url" : "www.item.ru"
                } ],
            "length" : ' . $length . ',
            "weight" : ' . $all_weights . ',
            "width" : ' . $width . '
            } ],
            "recipient" : {
                "name" : "' . $receiving_name_last_name_surname . '",
                "phones" : [ {
                "number" : "+'. $receiving_numbers_phone .'"
            } ]
            },
            "sender" : {
                "name" : "' . $sender_name_last_name_surname . '"
            },
            "services" : [ {
                "code" : "' . $services_code . '"
            } ],
            "tariff_code" : ' . $tariff_code .'
        }';
        //---------------------------------------------------------------------------
    }
}

