<?php


    require '../vendor/autoload.php';

    use CdekSDK2\BaseTypes;
    use CdekSDK2\Client;
    use CdekSDK2\Exceptions\AuthException;
    use Symfony\Component\HttpClient\Psr18Client;


    $client = new Psr18Client();
    $cdek = new Client($client);
    // Указываем имя и пароль
    $cdek->setAccount('EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI');
    $cdek->setSecure('PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG');



    // Принимаем данные в формате json и выводим в объект
    $json = json_decode(file_get_contents('php://input'));

    // Имя тарифа
    $tariffName = $json->tariffName;
    // Сумма доставки
    $deliverySum = $json->deliverySum;
    // минимальное время доставки
    $calendarMin = $json->calendarMin;
    // Максимальное время доставки
    $calendarMax = $json->calendarMax;

    //-------------------------------------------------------------------
    // Вход в аккаунт
    try {
        $cdek->authorize();
        $cdek->getToken();
        $cdek->getExpire();
        print_r('123123123');
    } catch (AuthException $exception) {
        //Авторизация не выполнена, не верные account и secure
        echo $exception->getMessage();
        print_r('error auth');
    }
    //-------------------------------------------------------------------
    // Создание заказа
    $order = BaseTypes\Order::create([
        'number' => '3627',
        'tariff_code' => '1',
        'sender' => BaseTypes\Contact::create([
            'name' => 'Vasya',
        ]),
        'recipient' => BaseTypes\Contact::create([
            'name' => 'Alexander',
            'phones' => [
                BaseTypes\Phone::create(['number' => '88001234567'])
            ]
        ]),
        'from_location' => BaseTypes\Location::create([
            'code' => 137,
            'country_code' => 'ru'
        ]),
        'to_location' => BaseTypes\Location::create([
            'code' => 270,
            'country_code' => 'ru',
            'address' => 'Титова 21 кв 9'
        ]),
        'packages' => [
            BaseTypes\Package::create([
                'number' => 'number1',
                'weight' => 1000,
                'length' => 12,
                'width' => 11,
                'height' => 8,
                'items' => [
                    BaseTypes\Item::create([
                        'name' => 'Toys for man',
                        'ware_key' => 'Items_number_5',
                        'payment' => BaseTypes\Money::create(['value' => 0]),
                        'cost' => 0,
                        'weight' => 1000,
                        'amount' => 1,
                    ]),
                ]
            ])
        ],
    ]);
    //-------------------------------------------------------------------
    // Отправка данных
    try {
        $result = $cdek->orders()->add($order);
        if ($result->isOk()) {
            //Запрос успешно выполнился
            $response_order = $cdek->formatResponse($result, BaseTypes\Order::class);
            // получаем UUID заказа и сохраняем его
            $response_order->entity->uuid;
        }
        if ($result->hasErrors()) {
            // Обрабатываем ошибки
        }
    } catch (RequestException $exception) {
        echo $exception->getMessage();
    }
    //-------------------------------------------------------------------


