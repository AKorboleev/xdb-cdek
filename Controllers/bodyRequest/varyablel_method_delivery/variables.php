<?php

//---------------------------------------------------------------------------
// Тут находятся основные переменные тела запроса
class variables
{
    //Код тарифа
    protected int $tariff_code;

    //Порог стоимости товара (действует по условию меньше или равно) в целых единицах валюты
    protected string $threshold;
    //Список телефонов не более 10 номеров
    protected string $phones;
    //Номер телефона отправителя должен передаваться в международном формате: код страны (для России +7) и сам номер (10 и более цифр)
    protected string $sender_numbers_phone;
    //Номер телефона получателя должен передаваться в международном формате: код страны (для России +7) и сам номер (10 и более цифр)
    protected string $receiving_numbers_phone;
    // Отправитель
    // Компания
    protected string $sender_company;
    //Получатель
    // Компания
    protected string $recipient_company;
    // Имя человека , кто получает
    protected string $recipient_name;
    //	ФИО контактного лица который отправляет
    protected string $sender_name_last_name_surname;
    //	ФИО контактного лица который получателя
    protected string $receiving_name_last_name_surname;
    //Строка адреса ru, en , большими буквами
    protected string $str_address;
    //Строка адреса ru, en , большими буквами
    // Регион доставки
    protected string $region;
    protected string $cub_region;
    protected string $city;
    //Тип дополнительной услуги
    protected string $code;
    //Строка адреса (по умолчанию RU)
    protected string $address;
    //Номер упаковки (можно использовать порядковый номер упаковки заказа или номер заказа), уникален в пределах заказа. Идентификатор заказа в ИС Клиента
    protected string $number_packages;
    //	Общий вес (в граммах)
    protected string $all_weights;
    //Да, если указаны остальные габариты
    protected bool $length;
    //да, если указаны остальные габариты
    //Габариты упаковки. Ширина (в сантиметрах)
    protected bool $width;
    //да, если указаны остальные габариты
    //Габариты упаковки. Высота (в сантиметрах)
    protected bool $height;
    // Наименование к упаковке
    protected bool $comments;
    //Наименование товара (может также содержать описание товара: размер, цвет)
    protected string $name;

}