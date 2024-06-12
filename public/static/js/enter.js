
let form = document.forms.login;
let ans = document.getElementById('ans');
let errors = document.getElementsByClassName('errors');
let countErrors = 0;
const SUCCESSUSER = "Авторизация пользователя прошла успешно";
const ERRORUSER = "Ошибка авторизации";


function validLogin() {
  form.login.value.length >= 1//поменять проверкку
  ? errors[0].innerHTML === 'Введите логин из смс'
      ? ( countErrors--,
          errors[0].innerHTML = '')
      : countErrors
  : errors[0].innerHTML === 'Введите логин из смс'
      ? countErrors
      : ( countErrors++,
          errors[0].innerHTML = 'Введите логин из смс')

//  console.log(countErrors);
//  console.log(errors[0]);
  return countErrors;
}

function validPwd() {
  form.pwd.value.length >= 1//поменять проверку
  ? errors[1].innerHTML === 'Введите пароль из смс'
      ? ( countErrors--,
          errors[1].innerHTML = '')
      : countErrors
  : errors[1].innerHTML === 'Введите пароль из смс'
      ? countErrors
      : ( countErrors++,
          errors[1].innerHTML = 'Введите пароль из смс')

//  console.log(countErrors);
//  console.log(errors[0]);
  return countErrors;
}

function validate() {
    validLogin();
    validPwd();
    //    console.log(countErrors);
//    console.log("Попытка отправки");
   if(countErrors > 0) {
        return false;
    }
    return true;
}


function sendForm(event) {
    event.preventDefault();
    if(!validate()) {
        return;
        }
    let request = new XMLHttpRequest();
    request.open('POST', "/login", true);//this.action

    let FD = new FormData(this);
    request.send(FD);

    for(let pair of FD.entries()) {
       console.log(pair[0]+ ', '+ pair[1]);
     }
    request.onload = function() {
      console.log(request.responseText);
      if(request.status === 200) {
            responseHandler(request.responseText);
        }
    }
}
form.addEventListener("submit", sendForm);

function resetForm() {
    for(i = 0; i < errors.length; i++) {
        errors[i].innerText = '';
    }
    ans.innerText = '';
    countErrors = 0;
}

function responseHandler(response) {
    if(response == SUCCESSUSER) {
        window.location.replace("/account");
      } else if (response == ERRORUSER) {
        ans.innerText = ERRORUSER;
    }
}
