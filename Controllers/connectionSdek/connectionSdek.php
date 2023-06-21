<?php

namespace connectionSdek;

class connectionSdek
{

    protected string $url;

    protected string $account;

    protected string $password;

    protected string $token;


    public function connect () : string
    {
            $account = 'WeW5myxqY83HEjJ7sv8njlGlChbm1ug8';
            $password = '3rYd7HGWtUkJWWIcQp5zNg2TwaeeXFXh';

            $url = "https://api.cdek.ru/v2/oauth/token?grant_type=client_credentials&client_id=$account&client_secret=$password";
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

            // Отправляем запрос по указанному url
            $result = file_get_contents($url, false, $context);
            $data = json_decode($result);

          $this->token = $data->access_token;



        return true;
    }

}
$connect = new connectionSdek();

$connect->connect();
