<?php


class variables_tariff
{
    //	Тип заказа:
    //1 - "интернет-магазин"
    //2 - "доставка"
    //По умолчанию - 1
    protected int $type;
    // Отправка откуда
    protected int $firstCity;
    // Куда
    protected int $lastCity;
}