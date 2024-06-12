
let form = document.forms.admin;
let ans = document.getElementById('ans');

const SUCCESSADMIN = "Авторизация админа прошла успешно";
const ERRORADMIN = "Ошибка авторизации";

function sendForm(event) {
    event.preventDefault();
    let request = new XMLHttpRequest();
    request.open('POST', "/admin", true);//this.action

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
admin.addEventListener("submit", sendForm);

function responseHandler(response) {
    if(response == SUCCESSADMIN) {
        window.location.replace("/admin/projects");
    } else if (response == ERRORADMIN) {
        ans.innerText = ERRORADMIN;
    }
}
