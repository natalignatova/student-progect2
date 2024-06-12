// let user_city = '<? echo $user['user_city']; ?>';
// let proj = '<? echo $json_projects; ?>';
// let proj_arr = JSON.parse(proj);

let sel_proj = document.getElementById('idProject');
let city = document.getElementById('city');

for (let i = 0; i < proj_arr.length; i++) {
      sel_proj[i].setAttribute('class', 'invis');
    }

function getProjects(){
  if (city.options[city.selectedIndex].value === user_city) {
    for (let i = 0; i < proj_arr.length; i++) {
          sel_proj[i].removeAttribute('class');
          sel_proj[i].removeAttribute('selected');
        }
    }
   if(city.options[city.selectedIndex].value !== user_city){
      for (let i = 0; i < proj_arr.length; i++) {
        sel_proj[i].setAttribute('class', 'invis');
          if(city.options[city.selectedIndex].value === proj_arr[i]['proj_city'] && sel_proj[i].value == proj_arr[i]['idProject']){
            sel_proj[i].setAttribute('selected', true);
            sel_proj[i].removeAttribute('class');
          }
        }
    }
  }

let trip = document.forms.trip;
let ans = document.getElementById('ans');

const SUCCESS = "Данные о поездке добавлены";
const ERROR = "Данные о поездке не добавлены. Заполните соответствующие поля формы";
const ERRORTICKET = "Загрузите билет перед отправкой";

function sendForm(event) {
    event.preventDefault();
    let request = new XMLHttpRequest();
    request.open('POST', "/account/addTrip", true);//this.action

    let ticketInput = document.getElementById('ticket');
    // console.log(idUserTripInput.files.length);
    if (ticketInput.files.length === 0){
      ans.innerText = ERRORTICKET;
      return;
    }

    let FD = new FormData(this);
    request.send(FD);
    //
    // for(let pair of FD.entries()) {
    //    console.log(pair[0]+ ', '+ pair[1]);
    //  }
    request.onload = function() {
      console.log(request.responseText);
        if(request.status === 200) {
            responseHandler(request.responseText);
        }
    }
}
trip.addEventListener("submit", sendForm);

function responseHandler(response) {
    if(response == SUCCESS) {
        window.location.replace("/account");
    } else if (response == ERROR) {
        ans.innerText = ERROR;
    }
}

// let idUserTripInput = document.getElementById('addTicket1');
// console.log(idUserTripInput.files.length);

function addUserTicket(trip_data) {
    event.preventDefault();
    let trip = trip_data.split(" ");
    let request = new XMLHttpRequest();
    request.open('POST', "/account/addUserTicket", true);//this.action

    let idUserTripInput = document.getElementById('addTicket'+trip[0]);
    // console.log(idUserTripInput.files.length);
    if (idUserTripInput.files.length === 0){
      let error = document.getElementById('error'+trip[0]);
      error.innerText = ERRORTICKET;
      return;
    }
    // console.log(idUserTripInput.files[0].value);
    let FD = new FormData();
    // if (!idUserTripInput.files[0]){
    //     event.preventDefault();
    //     window.location.replace("/account");
    // }
    FD.append('ticket', idUserTripInput.files[0]);
    FD.append('idUserTrip', trip[0]);
    FD.append('ticket_date', trip[1]);
    FD.append('city', trip[2]);
    request.send(FD);

    for(let pair of FD.entries()) {
       console.log(pair[0]+ ', '+ pair[1]);
     }
    request.onload = function() {
      // console.log(request.responseText);
      // console.log(request.status);
        if(request.status === 200) {
            responseAddTicket(request.responseText);
        }
    }
}


function responseAddTicket(response) {
    if(response == SUCCESS) {
          window.location.replace("/account");
    } else if (response == ERROR) {
        ans.innerText = ERROR;
    }
}
