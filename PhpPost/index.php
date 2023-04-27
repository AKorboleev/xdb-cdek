<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/PhpPost/style.css">
    <script src="/PhpPost/script.js"></script>
    <title>Document</title>
</head>
<body>
    <button type="submit" name="postSdek" onclick="postSdek()" class="btn_sdek" formmethod="POST">отправить</button>

    <div class="container__box" onclick="this.className = (this.className == 'container__box' ? 'container__box__click' : 'container__box')">
            <div class="container__name__delivery">
                <h3 class="tariff_name"></h3>
            </div>
            <div class="container__time__delivery">
                <div class="calendar__min"></div>
                <span class="dash">-</span>
                <div class="calendar__max"></div>
            </div>

            <div class="container_price">
                <div class="delivery_sum"></div>
            </div>
    <div/>
</body>
</html>