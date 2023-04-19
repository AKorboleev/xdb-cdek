// функция для запроса в handler.php за json файлом и вывод данных на страницу
//-------------------------------------------------------------------
async function postJson() {
    try {
            let response = await fetch('http://xdb-cdek/PhpPost/handler.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/application/json',
                },

                mode: 'no-cors',
                cache: 'no-cache',
            })

            if (!response.ok) {
                // Ошибка с получаемыми данными
                console.log("Ошибка HTTP: " + response.status);
            } else { // если HTTP-статус в диапазоне 200-299

                // Читаем ответ в формате JSON
                let content = await response.json();

                // Контейнер где хронятся все
                let containerBox = document.querySelector(".container__box")

                containerBox.style.display = "block"

                // Название тарифа
                let tariffName = document.querySelector("h3.tariff_name")

                // Минимальная доставка
                let calendarMin = document.querySelector(".calendar__min")

                // Максимальная доставка
                let calendarMax = document.querySelector(".calendar__max")

                // Сумма доставки
                let deliverySum = document.querySelector(".delivery_sum")

                // Цикл для вывода контента
                for (let k in content.tariff_codes) {

                    // Копируем контейнер с данными и выводим его
                    //-------------------------------------------------------------------
                    let containerClone = containerBox.cloneNode(true)
                    containerClone.style.display = 'block'
                    document.body.appendChild(containerClone)
                    //-------------------------------------------------------------------

                    // Данные которые требуется вывети
                    //-------------------------------------------------------------------
                    tariffName.textContent = content.tariff_codes[k].tariff_name
                    calendarMax.textContent = content.tariff_codes[k].calendar_max
                    calendarMin.textContent = content.tariff_codes[k].calendar_min
                    deliverySum.textContent = content.tariff_codes[k].delivery_sum
                    //-------------------------------------------------------------------
                }


            }
        } catch (error) {
            return  error;
        }
}
//-------------------------------------------------------------------

postJson();



// Отправляем в handler с данными доставки
//-------------------------------------------------------------------
async function postSdek() {

    let containerBox = document.querySelector(".container__box__click")


    // containerBox.from().forEach(containerBox => console.log(containerBox))


    // Название тарифа
    let tariffName = document.querySelector("h3.tariff_name")

    // Минимальная доставка
    let calendarMin = document.querySelector(".calendar__min")

    // Максимальная доставка
    let calendarMax = document.querySelector(".calendar__max")

    // Сумма доставки
    let deliverySum = document.querySelector(".delivery_sum")


    // // Название тарифа
    // let tariffName = document.querySelector("h3.tariff_name__click")
    //
    // // Минимальная доставка
    // let calendarMin = document.querySelector(".calendar__min__click")
    //
    // // Максимальная доставка
    // let calendarMax = document.querySelector(".calendar__max__click")
    //
    // // Сумма доставки
    // let deliverySum = document.querySelector(".delivery_sum__click")

    //массив с данными
    let delivery = {
        'tariffName': tariffName.textContent,
        'calendarMin': calendarMin.textContent,
        'calendarMax': calendarMax.textContent,
        'deliverySum': deliverySum.textContent,
    }

// Отправка данных выбранной доставки
//     "vendor/cdek-it/sdk2.0/sdek2.php"
    try {
        let response = await fetch('http://xdb-cdek/PhpPost/sdek2.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            mode: 'no-cors',
            cache: 'no-cache',
                body: JSON.stringify(delivery)
        })

        if (!response.ok) {
            // Ошибка с получаемыми данными
            console.log("Ошибка HTTP: " + response.status);
        } else { // если HTTP-статус в диапазоне 200-299
               console.log('запрос ушел')
        }
    } catch (error) {
        return error;
    }
}
//-------------------------------------------------------------------