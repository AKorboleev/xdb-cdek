//-------------------------------------------------------------------
// Отправляем в handler с данными доставки. Работает от onclick()
async function postSdek() {

    // Название тарифа
    let tariffName = document.querySelector('h3.tariff_name');
    // Минимальная доставка
    let calendarMin = document.querySelector('.calendar__min');
    // Максимальная доставка
    let calendarMax = document.querySelector('.calendar__max');
    // Сумма доставки
    let deliverySum = document.querySelector('.delivery_sum');
    // Массив с данными
    let delivery = {
        'tariffName': tariffName.textContent,
        'calendarMin': calendarMin.textContent,
        'calendarMax': calendarMax.textContent,
        'deliverySum': deliverySum.textContent,
    };
    console.log(delivery);

    // Отправка данных выбранной доставки
    try {
        let response = await fetch('http://xdb-cdek/PhpPost/handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            mode: 'no-cors',
            cache: 'no-cache',
            body: JSON.stringify(delivery)
        });
        // Проверка ушел ли запрос в sdek2.php
         if (!response.ok) {
            // Ошибка с получаемыми данными
             console.log('Ошибка HTTP: ' + response.status);
        }
        // если HTTP-статус в диапазоне 200-299
        else {
            console.log('Данные отправились');
        }
    } catch (error) {
        return error;
    }
}
//-------------------------------------------------------------------
// функция для запроса в handler.php за json файлом и вывод данных на страницу
async function postJson() {
    try {
        let response = await fetch('http://xdb-cdek/PhpPost/handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/application/json',
            },
            mode: 'no-cors',
            cache: 'no-cache',
        });
        // Проверка прошел ли запрос в handler.php
        if (!response.ok) {
            // Ошибка с получаемыми данными
             console.log('Ошибка HTTP: ' + response.status);
             console.log('crash');
        }
        // если HTTP-статус в диапазоне 200-299
        else {
            // Читаем ответ в формате JSON
            let content = await response.json();
            console.log(content);
            // Контейнер где хранится все
            let containerBox = document.querySelector('.container__box');
            // Вместо none меняем на block
            containerBox.style.display = 'block';
            // Название тарифа
            let tariffName = document.querySelector('h3.tariff_name');
            // Минимальная доставка
            let calendarMin = document.querySelector('.calendar__min');
            // Максимальная доставка
            let calendarMax = document.querySelector('.calendar__max');
            // Сумма доставки
            let deliverySum = document.querySelector('.delivery_sum');
            // Цикл для вывода контента
            for  (let k in content.tariff_codes) {
                //-------------------------------------------------------------------
                // Данные которые требуется вывети
                tariffName.textContent = content.tariff_codes[k].tariff_name;
                calendarMax.textContent = content.tariff_codes[k].calendar_max;
                calendarMin.textContent = content.tariff_codes[k].calendar_min;
                deliverySum.textContent = content.tariff_codes[k].delivery_sum;
                //-------------------------------------------------------------------
                //-------------------------------------------------------------------
                // Копируем контейнер с данными и выводим его
                let containerClone = containerBox.cloneNode(true)
                containerClone.style.display = 'block';
                document.body.appendChild(containerClone);
                //-------------------------------------------------------------------

            }
            console.log('Успешно выполнен')
        }
    } catch (error) {
        return  error;
    }
}
//-------------------------------------------------------------------

// Отправляем запрос в handler
postJson();