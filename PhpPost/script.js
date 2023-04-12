 async function postJson(){
      try {
     let response = await fetch('http://xdb-cdek/PhpPost/handler.php', {
          method:'POST',
          headers: {
               'Content-Type': 'application/application/json',
          },

          mode:'no-cors',
          cache: 'no-cache',
     })

     if (!response.ok) {
          console.log("Ошибка HTTP: " + response.status);
     } else { // если HTTP-статус в диапазоне 200-299
          // получаем тело ответа (см. про этот метод ниже)
          console.log("Ответ ")
          let content = await response.json(); // читаем ответ в формате JSON
          console.log( content)
          console.log(content.tariff_codes[0].tariff_name)
          console.log( JSON.stringify(content.tariff_codes))


          let containerBox = document.querySelector(".container__box")

          setTimeout(() => containerBox.style.display = "block", 1000 )

          // tariffName
          let tariffName = document.querySelector("h3.tariff_name")

          // calendarMin
          let calendarMin = document.querySelector(".calendar__min")

          // calendarMax
          let calendarMax = document.querySelector(".calendar__max")

          //deliverySum
          let deliverySum = document.querySelector(".delivery_sum")


               for (let k in content.tariff_codes) {

                    let containerClone = containerBox.cloneNode(true)
                    containerClone.style.display = 'block'
                    document.body.appendChild(containerClone)

                    calendarMax.textContent = content.tariff_codes[k].calendar_max

                    calendarMin.textContent = content.tariff_codes[k].calendar_min

                    tariffName.textContent = content.tariff_codes[k].tariff_name

                    deliverySum.textContent = content.tariff_codes[k].delivery_sum

               }



     }

}    catch(error) {
     return error;
}
}

postJson();


