//VALUE
const data = {
     'client_id': 'EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI',
     'client_secret': 'PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG',
}

async function getAPIAnswerFromCdek(){
     try {
          let response = await fetch('https://api.edu.cdek.ru/v2/oauth/token?grant_type=client_credentials&client_id=EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI&client_secret=PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG', {
               method:'POST',
               headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
               },
//               body: JSON.stringify(data),
               mode:'no-cors',
               // cache: 'no-cache',
          })
//          console.log(response)
          return response.json()

     }    catch(err) {
          return err;
     }

}

function main() {
     console.log("hhh");
     let result = getAPIAnswerFromCdek().then(r => console.log(r));
     console.log(result);
}

main()