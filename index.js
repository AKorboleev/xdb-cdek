const data = {
     'client_id': '1',
     'client_secret': '1'
}

async function getAPIAnswerFromCdek(){
     try {
          let response = await fetch('https://api.edu.cdek.ru/v2/oauth/token?parameters', {
               method:'POST',
               headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
               },
               body: JSON.stringify(data),
               mode:'no-cors',
               cache: 'no-cache',
          })
          return response.json();         
          
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
