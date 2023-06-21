<?php

namespace request;

use connectionSdek\connectionSdek;

class postSdek extends connectionSdek
{


    public function curlPostarifs($curUrl)
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
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'https://api.cdek.ru/v2/calculator/tarifflist?=');
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

}

$corl = new postSdek();

$corl->curlPostarifs();