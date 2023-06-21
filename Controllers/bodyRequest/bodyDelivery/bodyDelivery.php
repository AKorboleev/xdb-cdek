<?php

namespace bodyDelivery;

use variables\variables;


class bodyDelivery extends variables
{

    public function construct() : string
    {
        return '{
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
                     "weight": "1000",
                     "length": 10,
                     "width": 140,
                     "height": 140,
                     "comment": "Комментарий к упаковке"
                 }
             ]
         }';
    }

}