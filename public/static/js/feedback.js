let errors = document.getElementsByClassName('errors');

let form = document.forms.client;
let ans = document.getElementById('ans');
let countErrors = 0;
const SUCCESS = "Запрос отправлен";
const ERROR = "Ошибка отправки запроса";

function validName() {
  form.client_name.value.length >= 1
  ? errors[0].innerHTML === 'Введите имя'
      ? ( countErrors--,
          errors[0].innerHTML = '')
      : countErrors
  : errors[0].innerHTML === 'Введите имя'
      ? countErrors
      : ( countErrors++,
          errors[0].innerHTML = 'Введите имя')
  return countErrors;
}

function validPhone() {
    let re = /^\d[\d\(\)\ -]{4,14}\d$/;
    re.test(form.phone.value)
    ? errors[2].innerHTML === 'Введите номер телефона из 11 цифр'
        ? ( countErrors--,
            errors[2].innerHTML = '')
        : countErrors
    : errors[2].innerHTML === 'Введите номер телефона из 11 цифр'
        ? countErrors
        : ( countErrors++,
            errors[2].innerHTML = 'Введите номер телефона из 11 цифр')

    return countErrors;
}

function validMail() {
    let re = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
    re.test(form.e_mail.value)
    ? errors[3].innerHTML === 'Введите email'
        ? ( countErrors--,
            errors[3].innerHTML = '')
        : countErrors
    : errors[3].innerHTML === 'Введите email'
        ? countErrors
        : ( countErrors++,
            errors[3].innerHTML = 'Введите email')

    return countErrors;
  }

function validReq() {
    form.request.value.length >= 1
    ? errors[4].innerHTML === 'Заполните запрос'
        ? ( countErrors--,
            errors[4].innerHTML = '')
        : countErrors
    : errors[4].innerHTML === 'Заполните запрос'
        ? countErrors
        : ( countErrors++,
            errors[4].innerHTML = 'Заполните запрос')


    return countErrors;
  }

function validate() {
    validName();
    validPhone();
    validMail();
    validReq();

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
//console.log("onload");
    let request = new XMLHttpRequest();

    request.open('POST', "/contacts", true);//this.action

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
    if(response == SUCCESS) {
        ans.innerText = SUCCESS;
    } else if (response == ERROR) {
        ans.innerText = ERROR;
    }
}
