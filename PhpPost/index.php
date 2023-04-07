<?php

require '../vendor/autoload.php';



use GuzzleHttp\Client;

    function getToken() {
        $client  = new Client();

        $response = $client->request('POST', 'https://api.edu.cdek.ru/v2/oauth/token?grant_type=client_credentials&client_id=EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI&client_secret=PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG', [
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

    //это мы получаем
    //object(stdClass)#32 (5) {
    //["access_token"]=>
    //  string(1282) "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJzY29wZSI6WyJvcmRlcjphbGwiLCJwYXltZW50OmFsbCJdLCJleHAiOjE2ODA4NDM5NTAsImF1dGhvcml0aWVzIjpbInNoYXJkLWlkOnJ1LTAxIiwiY2xpZW50LWNpdHk60J3QvtCy0L7RgdC40LHQuNGA0YHQuiwg0J3QvtCy0L7RgdC40LHQuNGA0YHQutCw0Y8g0L7QsdC70LDRgdGC0YwiLCJmdWxsLW5hbWU60KLQtdGB0YLQuNGA0L7QstCw0L3QuNC1INCY0L3RgtC10LPRgNCw0YbQuNC4INCY0JwsINCe0JHQqdCV0KHQotCS0J4g0KEg0J7Qk9Cg0JDQndCY0KfQldCd0J3QntCZINCe0KLQktCV0KLQodCi0JLQldCd0J3QntCh0KLQrNCuIiwiYWNjb3VudC1sYW5nOnJ1cyIsImNvbnRyYWN0OtCY0Jwt0KDQpC3Qk9Cb0JMtMjIiLCJhY2NvdW50LXV1aWQ6ZTkyNWJkMGYtMDVhNi00YzU2LWI3MzctNGI5OWMxNGY2NjlhIiwiYXBpLXZlcnNpb246MS4xIiwiY2xpZW50LWlkLWVjNTplZDc1ZWNmNC0zMGVkLTQxNTMtYWZlOS1lYjgwYmI1MTJmMjIiLCJjbGllbnQtaWQtZWM0OjE0MzQ4MjMxIiwic29saWQtYWRkcmVzczpmYWxzZSIsImNvbnRyYWdlbnQtdXVpZDplZDc1ZWNmNC0zMGVkLTQxNTMtYWZlOS1lYjgwYmI1MTJmMjIiXSwianRpIjoiOTlhZjk2MjktM2RlOC00OWFjLWI1NWYtMmRlNTViZjFmYjJmIiwiY2xpZW50X2lkIjoiRU1zY2Q2cjlKbkZpUTNiTG95akpZNmVNNzhKckpjZUkifQ.I8gu9Z2xP9w3HXbK_Fs775gqCMP8nFafS2AOH3QpkAURdekk1A87YpSOUlsEGSxX-XLHHouna3xszCgR75u8djHiXr-iOCfdrJzCdQ3722G_swROdRXxfoSd0TtvcZnNgPcWlpdcS8jP5jHlajyebHWn89p2KlqeG0QsqXvaBE1g77-KA0DO-dZaVN-K0PnKQpwt6atyRdUh5d0ERfbQLDgaao4nUnwgwy7DzFsYkSKq_CxSVKcnANuuFv7nFFRrc5bVARrGHlP90nbCw8_JAq7RN7mc49rZf-y8Zc8JW1SZ3HIBiC6BTqCqZAf-zcmMGrVDvpes6zQxQbTSTl_8DQ"
    //["token_type"]=>
    //  string(6) "bearer"
    //["expires_in"]=>
    //  int(3599)
    //  ["scope"]=>
    //  string(21) "order:all payment:all"
    //["jti"]=>
    //  string(36) "99af9 629-3de8-49ac-b55f-2de55bf1fb2f"
    //}

    getToken();

    function orderReg () {

        $json = '{
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

        $data = json_decode($json, true);

        tt($data);

        $client  = new Client();
        //'https://api.edu.cdek.ru/v2/calculator/tarifflist'
        try {
            $response = $client->request('POST', 'https://api.edu.cdek.ru/v2/calculator/tarifflist', [
                'header' => ['Content-type' => 'application/json',
                    'Authentication' => 'bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJzY29wZSI6WyJvcmRlcjphbGwiLCJwYXltZW50OmFsbCJdLCJleHAiOjE2ODA4NTc2MzIsImF1dGhvcml0aWVzIjpbInNoYXJkLWlkOnJ1LTAxIiwiY2xpZW50LWNpdHk60J3QvtCy0L7RgdC40LHQuNGA0YHQuiwg0J3QvtCy0L7RgdC40LHQuNGA0YHQutCw0Y8g0L7QsdC70LDRgdGC0YwiLCJhY2NvdW50LWxhbmc6cnVzIiwiY29udHJhY3Q60JjQnC3QoNCkLdCT0JvQky0yMiIsImFjY291bnQtdXVpZDplOTI1YmQwZi0wNWE2LTRjNTYtYjczNy00Yjk5YzE0ZjY2OWEiLCJhcGktdmVyc2lvbjoxLjEiLCJjbGllbnQtaWQtZWM1OmVkNzVlY2Y0LTMwZWQtNDE1My1hZmU5LWViODBiYjUxMmYyMiIsImNsaWVudC1pZC1lYzQ6MTQzNDgyMzEiLCJjb250cmFnZW50LXV1aWQ6ZWQ3NWVjZjQtMzBlZC00MTUzLWFmZTktZWI4MGJiNTEyZjIyIiwic29saWQtYWRkcmVzczpmYWxzZSIsImZ1bGwtbmFtZTrQotC10YHRgtC40YDQvtCy0LDQvdC40LUg0JjQvdGC0LXQs9GA0LDRhtC40Lgg0JjQnCJdLCJqdGkiOiI0NjJiNGIwNS0xZTYwLTQ3MjUtYWQyNS02YzRhZDQ5ZGE2N2EiLCJjbGllbnRfaWQiOiJFTXNjZDZyOUpuRmlRM2JMb3lqSlk2ZU03OEpySmNlSSJ9.Xz_aRZJ6eXdltP0gX_N_UfOqONqwZWaMOoYxXR3xIQX8M-nITWZXSVvOsFtDXiYeAVEcaHEvM4umXAmPO7ZtMLNXSx_jp-LLlIQyJfYVVm1TNOAHVa6H9hmLJWMRcGBxoDFjqUTYgFz6vmiJfopfV0eq38oMAyW2uqbYSJswYB8mYqonPTWF3FgnKMFaLHwEipFa1Kdzg1IasR0y1e87Z6pRPN0WlaLmG9nkFYUltLCGc8aZgoEdP6jeymWa8JyB6nDrKdRR2vbmpmRUGZxPfOUrXf-94tagOUQzbF9xUohffQTTUl4QWlp3voBnGib_zl636srr_xtbqO221tfWnA',
                    ],

                'body' => $json,
            ]);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            echo $e;
        }

        //проверка
        tt($response->getBody()->getContents());

    }

    orderReg();
// нужно ли это добвлять в header ?





function tt($data) {
    echo '<pre>';
    echo print_r($data);
    echo '</pre>';
};