//VALUE
const data = {
     'client_id': 'EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI',
     'client_secret': 'PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG',
}


async function getAPIAnswerFromCdek(){
     try {
          // alert(1);
          let response = await fetch('https://api.edu.cdek.ru/v2/oauth/token?grant_type=client_credentials&client_id=EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI&client_secret=PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG', {
               method:'POST',
               headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    //при обращении к методам сервиса полученный токен передается в заголовке запроса в следующем виде.
                    // Authentication: 'Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJzY29wZSI6WyJvcmRlcjphbGw...'
               },

               //body: JSON.stringify(data), // Показывает данные формы
               mode:'no-cors',
//               cache: 'no-cache',
          })
          // alert(2);
          //проверка
          // alert(response.ok);
          if (response.ok) { // если HTTP-статус в диапазоне 200-299
                             // получаем тело ответа (см. про этот метод ниже)
               console.log("Запрос прошел")
               return response.json();
          } else {
               console.log("Ошибка HTTP: " + response.status);
          }

          // let commits = await response.FormData(); // читаем ответ в формате JSON
          //
          // alert(commits[0]);

          // return response.json()

     }    catch(error) {
          return error;
     }

}

getAPIAnswerFromCdek()

// function main() {
//      console.log("main");
//      let result = getAPIAnswerFromCdek().then(r => console.log(r));
//      console.log(result);
// }
//
// main()



//синхронный запрос

// function postAPICdek () {
//      try {
//           let xhr = new XMLHttpRequest()
//           xhr.open('POST','https://api.edu.cdek.ru/v2/oauth/token?grant_type=client_credentials&client_id=EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI&client_secret=PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG',[false]);
//           xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
//
//
//           xhr.onload = function() {
//                if (xhr.status != 200) { // анализируем HTTP-статус ответа, если статус не 200, то произошла ошибка
//                     alert(`Ошибка ${xhr.status}: ${xhr.statusText}`); // Например, 404: Not Found
//                } else { // если всё прошло гладко, выводим результат
//                     alert(`Готово, получили ${xhr.response.length} байт`); // response -- это ответ сервера
//                }
//           };
//
//           xhr.onerror = function() {
//                console.log("Запрос не удался");
//           };
//
//           xhr.send([])//запрос на сервер
//           //
//           // return xhr.json()
//
//      }    catch(error) {
//           return error;
//      }
// }
//
// postAPICdek()