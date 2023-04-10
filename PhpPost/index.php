<?php

require '../vendor/autoload.php';



use GuzzleHttp\Client;

//Написать авто замену токена.
//Когда он заменяется все перестает работать !!! Пофиксить на этой неделе


    function getToken() {
        $client  = new Client();
        $url = 'https://api.edu.cdek.ru/v2/oauth/token?grant_type=client_credentials&client_id=EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI&client_secret=PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG';

        $response = $client->request('POST', $url, [
            'header' => ['Content-type' => 'application/x-www-form-urlencoded',],
//            'form_params' => [
//                "grant-type" => "client_credentials",
//                "client_id" => "EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI",
//                "client_secret" => "PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG"
//            ]
        ]);
        $data = json_decode($response->getBody()->getContents()); // запрос форматируется в json формат
        tt($data);//выводим json код


    };


    getToken();

//    function orderReg () {
//
//        $json = '{
//    "type": 1,
//    "date": "2020-11-03T11:49:32+0700",
//    "currency": 1,
//    "lang": "rus",
//    "from_location": {
//        "code": 270
//    },
//    "to_location": {
//        "code": 44
//    },
//    "packages": [
//        {
//            "height": 10,
//            "length": 10,
//            "weight": 4000,
//            "width": 10
//        }
//    ]
//}';
//
////        $data = json_decode($json, true);// массив, а его передавать нет смысла, так как body не принимает массив, только строку
//
////        tt($data);
//
//
//
//        $client  = new Client();
//        //'https://api.edu.cdek.ru/v2/calculator/tarifflist'
//
//            $response = $client->request('POST', 'https://api.edu.cdek.ru/v2/calculator/tarifflist', [
//                'header' => ['Content-type' => 'application/json',
//                    'Authentication' => 'bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJzY29wZSI6WyJvcmRlcjphbGwiLCJwYXltZW50OmFsbCJdLCJleHAiOjE2ODA4NTc2MzIsImF1dGhvcml0aWVzIjpbInNoYXJkLWlkOnJ1LTAxIiwiY2xpZW50LWNpdHk60J3QvtCy0L7RgdC40LHQuNGA0YHQuiwg0J3QvtCy0L7RgdC40LHQuNGA0YHQutCw0Y8g0L7QsdC70LDRgdGC0YwiLCJhY2NvdW50LWxhbmc6cnVzIiwiY29udHJhY3Q60JjQnC3QoNCkLdCT0JvQky0yMiIsImFjY291bnQtdXVpZDplOTI1YmQwZi0wNWE2LTRjNTYtYjczNy00Yjk5YzE0ZjY2OWEiLCJhcGktdmVyc2lvbjoxLjEiLCJjbGllbnQtaWQtZWM1OmVkNzVlY2Y0LTMwZWQtNDE1My1hZmU5LWViODBiYjUxMmYyMiIsImNsaWVudC1pZC1lYzQ6MTQzNDgyMzEiLCJjb250cmFnZW50LXV1aWQ6ZWQ3NWVjZjQtMzBlZC00MTUzLWFmZTktZWI4MGJiNTEyZjIyIiwic29saWQtYWRkcmVzczpmYWxzZSIsImZ1bGwtbmFtZTrQotC10YHRgtC40YDQvtCy0LDQvdC40LUg0JjQvdGC0LXQs9GA0LDRhtC40Lgg0JjQnCJdLCJqdGkiOiI0NjJiNGIwNS0xZTYwLTQ3MjUtYWQyNS02YzRhZDQ5ZGE2N2EiLCJjbGllbnRfaWQiOiJFTXNjZDZyOUpuRmlRM2JMb3lqSlk2ZU03OEpySmNlSSJ9.Xz_aRZJ6eXdltP0gX_N_UfOqONqwZWaMOoYxXR3xIQX8M-nITWZXSVvOsFtDXiYeAVEcaHEvM4umXAmPO7ZtMLNXSx_jp-LLlIQyJfYVVm1TNOAHVa6H9hmLJWMRcGBxoDFjqUTYgFz6vmiJfopfV0eq38oMAyW2uqbYSJswYB8mYqonPTWF3FgnKMFaLHwEipFa1Kdzg1IasR0y1e87Z6pRPN0WlaLmG9nkFYUltLCGc8aZgoEdP6jeymWa8JyB6nDrKdRR2vbmpmRUGZxPfOUrXf-94tagOUQzbF9xUohffQTTUl4QWlp3voBnGib_zl636srr_xtbqO221tfWnA',
//                    ],
//
//                'body' => $json,
//            ]);
//
//        //проверка
//        tt($response->getBody()->getContents());
//
//    }
//
//    orderReg();



    function postJson () {

        $body = '{
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
}';
        $token = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJzY29wZSI6WyJvcmRlcjphbGwiLCJwYXltZW50OmFsbCJdLCJleHAiOjE2ODExMzM4MTIsImF1dGhvcml0aWVzIjpbInNoYXJkLWlkOnJ1LTAxIiwiY2xpZW50LWNpdHk60J3QvtCy0L7RgdC40LHQuNGA0YHQuiwg0J3QvtCy0L7RgdC40LHQuNGA0YHQutCw0Y8g0L7QsdC70LDRgdGC0YwiLCJjb250cmFjdDrQmNCcLdCg0KQt0JPQm9CTLTIyIiwiYWNjb3VudC1sYW5nOnJ1cyIsImFjY291bnQtdXVpZDplOTI1YmQwZi0wNWE2LTRjNTYtYjczNy00Yjk5YzE0ZjY2OWEiLCJhcGktdmVyc2lvbjoxLjEiLCJjbGllbnQtaWQtZWM1OmVkNzVlY2Y0LTMwZWQtNDE1My1hZmU5LWViODBiYjUxMmYyMiIsImNsaWVudC1pZC1lYzQ6MTQzNDgyMzEiLCJjb250cmFnZW50LXV1aWQ6ZWQ3NWVjZjQtMzBlZC00MTUzLWFmZTktZWI4MGJiNTEyZjIyIiwic29saWQtYWRkcmVzczpmYWxzZSIsImZ1bGwtbmFtZTrQotC10YHRgtC40YDQvtCy0LDQvdC40LUg0JjQvdGC0LXQs9GA0LDRhtC40Lgg0JjQnCJdLCJqdGkiOiIzYzdkNjUyYy0yZThjLTRkYTYtYjQzNS1iOTE4OTc3OGMwYjEiLCJjbGllbnRfaWQiOiJFTXNjZDZyOUpuRmlRM2JMb3lqSlk2ZU03OEpySmNlSSJ9.eA-YgxAsLRjX55POtCLm0eihwAw28vJZti-W7cQPNLLySPJTRNhaWfzahnGBy0qDgPOkSSb2OUpTrqgom0iHEb9K5c3UMQq0L1kC792LtRG7TnhFNgyPKultBKuIB1JKFoRmONTFxl8KC8r9hWG6kWgrj_ZLgpvBAGIbEJQt-Q98a8zmDmpavL44BYu3c49oz7LCxD5Z_dGZqFkGT17k5kHdXKC17astx-cxU5nZeEGF4KeWJ9oqNS5m9MfAMYAqPlf7W3aqAknj0JB86yS2BX9DgCgO-SsQnQlnp-UGq_2sFAF0xGCY9t0lX42OFvHHsm328LHyMCkJxmcaW0SFWA';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.edu.cdek.ru/v2/calculator/tarifflist");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json, charset=UTF-8",
              "Authorization: Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJzY29wZSI6WyJvcmRlcjphbGwiLCJwYXltZW50OmFsbCJdLCJleHAiOjE2ODExMzA2NjMsImF1dGhvcml0aWVzIjpbInNoYXJkLWlkOnJ1LTAxIiwiY2xpZW50LWNpdHk60J3QvtCy0L7RgdC40LHQuNGA0YHQuiwg0J3QvtCy0L7RgdC40LHQuNGA0YHQutCw0Y8g0L7QsdC70LDRgdGC0YwiLCJjb250cmFjdDrQmNCcLdCg0KQt0JPQm9CTLTIyIiwiYWNjb3VudC1sYW5nOnJ1cyIsImFwaS12ZXJzaW9uOjEuMSIsImFjY291bnQtdXVpZDplOTI1YmQwZi0wNWE2LTRjNTYtYjczNy00Yjk5YzE0ZjY2OWEiLCJjbGllbnQtaWQtZWM1OmVkNzVlY2Y0LTMwZWQtNDE1My1hZmU5LWViODBiYjUxMmYyMiIsImNsaWVudC1pZC1lYzQ6MTQzNDgyMzEiLCJjb250cmFnZW50LXV1aWQ6ZWQ3NWVjZjQtMzBlZC00MTUzLWFmZTktZWI4MGJiNTEyZjIyIiwic29saWQtYWRkcmVzczpmYWxzZSIsImZ1bGwtbmFtZTrQotC10YHRgtC40YDQvtCy0LDQvdC40LUg0JjQvdGC0LXQs9GA0LDRhtC40Lgg0JjQnCJdLCJqdGkiOiI1NWQ0N2RhNy1hNDg1LTRiNWMtODU5Mi1hYzc3MGEzNDQwNWMiLCJjbGllbnRfaWQiOiJFTXNjZDZyOUpuRmlRM2JMb3lqSlk2ZU03OEpySmNlSSJ9.QBNLnZ2IwqNz-o-FbAx9fngrxavcUL6JxE6QI0gqCq2L3BZysLcfelShSc8uBC7GwlZ49-myL68I0V7P_QjrpVY_t6nypxmojHOCkjISKVqNbF4tPG8Lep40PtgrIil-tr1NsRHy7g-4wlWAdjYYy6qVxAKWCmKEkRo0zB9Au4OxtlvQ71-oyKXP6PEHxUytT_-Gvz13lB1IgPKlJ-VIXpMFk097dH6a1TDMzaSsRGp7ZTSayxLkU7gIOitBeMtBXELxUaclbXimq0MaxL96jrPI4Xdlc2bhZ0dJmDFLSNAoJNe8hrS7c0cvP69yp--sBXrH01X009xD3PTvs9H2pQ",
               'Accept: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_XOAUTH2_BEARER, $token); //oauth2.0 подключен, но не правильно ((
        $result = curl_exec($ch);
       tt($result);
    }

//    postJson();


    //улучшенная функция запроса

function jwt_request($token, $post) {

    $header = 'Content-Type: application/json'; // Укажите тип данных
    $ch = curl_init('https://api.edu.cdek.ru/v2/calculator/tarifflist'); // Инициализировать cURL
    $post = json_encode($post); // Кодировать массив данных в строку JSON
    $authorization = "Authorization: Bearer ".$token; // Подготовка токена к авторизации
    ////test не работает
//    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BEARER);
//    curl_setopt($ch,CURLOPT_XOAUTH2_BEARER,$token);

    //если заменить CURLOPT_HTTPHEADER на  CURLOPT_XOAUTH2_BEARER, то появляется ошибка "Authorization header is incorrect"
    //но если не ставить CURLOPT_XOAUTH2_BEARER то ошибка с array.
    curl_setopt($ch, CURLOPT_HTTPHEADER, array($header , $authorization )); // Ставим токен в заголовок
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1); // Укажите метод запроса как POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // поля публикации , но это не точно
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // Следовать за переадресациями
    $result = curl_exec($ch); // Выполнить запрос
    curl_close($ch); //прекратить запрос
    tt(json_decode($result)); // Вернуть полученные данные
    return json_decode($result);



}

jwt_request('eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJzY29wZSI6WyJvcmRlcjphbGwiLCJwYXltZW50OmFsbCJdLCJleHAiOjE2ODExMjk4MTgsImF1dGhvcml0aWVzIjpbInNoYXJkLWlkOnJ1LTAxIiwiY2xpZW50LWNpdHk60J3QvtCy0L7RgdC40LHQuNGA0YHQuiwg0J3QvtCy0L7RgdC40LHQuNGA0YHQutCw0Y8g0L7QsdC70LDRgdGC0YwiLCJhY2NvdW50LWxhbmc6cnVzIiwiY29udHJhY3Q60JjQnC3QoNCkLdCT0JvQky0yMiIsImFwaS12ZXJzaW9uOjEuMSIsImFjY291bnQtdXVpZDplOTI1YmQwZi0wNWE2LTRjNTYtYjczNy00Yjk5YzE0ZjY2OWEiLCJjbGllbnQtaWQtZWM1OmVkNzVlY2Y0LTMwZWQtNDE1My1hZmU5LWViODBiYjUxMmYyMiIsImNsaWVudC1pZC1lYzQ6MTQzNDgyMzEiLCJjb250cmFnZW50LXV1aWQ6ZWQ3NWVjZjQtMzBlZC00MTUzLWFmZTktZWI4MGJiNTEyZjIyIiwic29saWQtYWRkcmVzczpmYWxzZSIsImZ1bGwtbmFtZTrQotC10YHRgtC40YDQvtCy0LDQvdC40LUg0JjQvdGC0LXQs9GA0LDRhtC40Lgg0JjQnCJdLCJqdGkiOiI5MDI2MjFlYy0yZjJjLTRiN2QtYTVmYS04Y2QyOGY4NWUyYTYiLCJjbGllbnRfaWQiOiJFTXNjZDZyOUpuRmlRM2JMb3lqSlk2ZU03OEpySmNlSSJ9.TmcqA6kpwrBREShdoFyw8TFBtcLZKAoeL1ZgOeplFEjJp29PyNqkOzA2x7s0-sF1vE9lZfsO_zBB5Ol9lBJQA1ZDK6vUMTJYXNFeafrYiMxyOlegMWAY6lZeZDwfM3I7ESy7SkVivT0VrDsAuzzTrQQXfysv6KjjitzgHiJPiqVrV9sotc6xIOnnHDp3yBr2N-EyuLl73Lo3tp42AfZHHLtHapBXSTlU2NXLFBAaaGgc3aRkBSATOgwdttIcTJzHT6HLZG-Jc3lku7GzWQiL0MPdIpiflF0dEN87pNhgg24NA_LOj9jD0xZM3KPp30bh2ij1jetMbP3TbKOYGTrShQ',
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
}'
);

// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.edu.cdek.ru/v2/calculator/tarifflist?=');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n    \"type\": 1,\n    \"date\": \"2020-11-03T11:49:32+0700\",\n    \"currency\": 1,\n    \"lang\": \"rus\",\n    \"from_location\": {\n        \"code\": 270\n    },\n    \"to_location\": {\n        \"code\": 44\n    },\n    \"packages\": [\n        {\n            \"height\": 10,\n            \"length\": 10,\n            \"weight\": 4000,\n            \"width\": 10\n        }\n    ]\n}");

$headers = array();
$headers[] = 'Authorization: Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJzY29wZSI6WyJvcmRlcjphbGwiLCJwYXltZW50OmFsbCJdLCJleHAiOjE2ODExMzM4MTIsImF1dGhvcml0aWVzIjpbInNoYXJkLWlkOnJ1LTAxIiwiY2xpZW50LWNpdHk60J3QvtCy0L7RgdC40LHQuNGA0YHQuiwg0J3QvtCy0L7RgdC40LHQuNGA0YHQutCw0Y8g0L7QsdC70LDRgdGC0YwiLCJjb250cmFjdDrQmNCcLdCg0KQt0JPQm9CTLTIyIiwiYWNjb3VudC1sYW5nOnJ1cyIsImFjY291bnQtdXVpZDplOTI1YmQwZi0wNWE2LTRjNTYtYjczNy00Yjk5YzE0ZjY2OWEiLCJhcGktdmVyc2lvbjoxLjEiLCJjbGllbnQtaWQtZWM1OmVkNzVlY2Y0LTMwZWQtNDE1My1hZmU5LWViODBiYjUxMmYyMiIsImNsaWVudC1pZC1lYzQ6MTQzNDgyMzEiLCJjb250cmFnZW50LXV1aWQ6ZWQ3NWVjZjQtMzBlZC00MTUzLWFmZTktZWI4MGJiNTEyZjIyIiwic29saWQtYWRkcmVzczpmYWxzZSIsImZ1bGwtbmFtZTrQotC10YHRgtC40YDQvtCy0LDQvdC40LUg0JjQvdGC0LXQs9GA0LDRhtC40Lgg0JjQnCJdLCJqdGkiOiIzYzdkNjUyYy0yZThjLTRkYTYtYjQzNS1iOTE4OTc3OGMwYjEiLCJjbGllbnRfaWQiOiJFTXNjZDZyOUpuRmlRM2JMb3lqSlk2ZU03OEpySmNlSSJ9.eA-YgxAsLRjX55POtCLm0eihwAw28vJZti-W7cQPNLLySPJTRNhaWfzahnGBy0qDgPOkSSb2OUpTrqgom0iHEb9K5c3UMQq0L1kC792LtRG7TnhFNgyPKultBKuIB1JKFoRmONTFxl8KC8r9hWG6kWgrj_ZLgpvBAGIbEJQt-Q98a8zmDmpavL44BYu3c49oz7LCxD5Z_dGZqFkGT17k5kHdXKC17astx-cxU5nZeEGF4KeWJ9oqNS5m9MfAMYAqPlf7W3aqAknj0JB86yS2BX9DgCgO-SsQnQlnp-UGq_2sFAF0xGCY9t0lX42OFvHHsm328LHyMCkJxmcaW0SFWA';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
tt($result);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);


function tt($data) {
    echo '<pre>';
    echo print_r($data);
    echo '</pre>';
};

