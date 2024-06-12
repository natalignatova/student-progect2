const SUCCESS = "Добавлено";
const ERROR = "Не добавлено";
const SUCCESSDEL = "Удалено";
const ERRORDEL = "Не удалено";
const SUCCESSCHANGE = "Изменено";
const ERRORCHANGE = "Не изменено";

let ans = document.getElementById('ans');

let adduser = document.getElementById('adduser');
adduser.setAttribute('class', 'invis');

let showuser = document.getElementById('showuser');
showuser.setAttribute('class', 'invis');

let input_user = showuser.querySelectorAll('input[type="text"]');

let inp_date_user = showuser.querySelectorAll('input[type="date"]');

for (let i = 0; i < input_user.length; i++) {
  input_user[i].setAttribute("readonly", true);
}

let input_add = adduser.querySelectorAll('input[type="text"]');
let inp_date_add = adduser.querySelectorAll('input[type="date"]');
let inps = adduser.getElementsByTagName('input');
// console.log(inps);
// for (let i = 0; i < inps.length; i++) {
//   inps[i].setAttribute("readonly", true);
// }

// let user_login = document.getElementById('user_login');
// let user_pwd = document.getElementById('user_pwd');
// let user_surname = document.getElementById('user_surname');
// let user_name = document.getElementById('user_name');

let bAF = document.getElementById('showAddForm');
let bSU = document.getElementById('sendFormUser');


let bRF = document.getElementById('resetForm');
let bRF2 = document.getElementById('resetForm2');
let bRF3 = document.getElementById('resetForm3');
// let sAN = document.getElementById('stringAddNews');

let del = document.getElementById('del');
del.setAttribute("class", "invis");

let checkboxes = document.querySelectorAll('input[type="checkbox"]');
for (let i = 0; i < checkboxes.length; i++) {
  checkboxes[i].parentNode.setAttribute("class", "invis");
}

let date = document.querySelectorAll('input[type="date"]');
for (let i = 0; i < date.length; i++) {
  date[i].parentNode.setAttribute("class", "invis");
  date[i].setAttribute("readonly", true);
}

bRF.setAttribute("class", "invis");
bRF3.setAttribute("class", "invis");


let bShowDel = document.getElementById('showDeleteForm');
let bDU = document.getElementById('DeleteFormUser');
bDU.setAttribute("class", "invis");
let bShowChange = document.getElementById('showChangeForm');
let bChUser = document.getElementById('ChangeFormUser');
bChUser.setAttribute("class", "invis");

let sa = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];

function getDate(date){
  let dat = date.split(" ");
  let da = dat[0].split('-');
  return  da[2]+'.'+da[1]+'.'+da[0];
}


function showUser(idUser) {

   // bAF.setAttribute("class", "invis");
     showuser.setAttribute("class", " col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 mb-5");
     // bAF.setAttribute("class", "invis");
     // bShowDel.setAttribute("class", "invis");
     let idCity, ulogin;
     let profile = document.getElementById('profile');
     profile.setAttribute('name', idUser);
     // profile.removeChild(document.getElementsByTagName("table")[0]);

     for (let i = 0; i < users_arr.length; i++) {
        if (users_arr[i]['idUser'] == idUser){
          document.getElementById('home-tab').innerHTML = users_arr[i]['user_surname'] + ' ' + users_arr[i]['user_name'];
          document.getElementById('user_surname').value = users_arr[i]['user_surname'];
          document.getElementById('user_name').value = users_arr[i]['user_name'];
          document.getElementById('user_second_name').value = users_arr[i]['user_second_name'];
          document.getElementById('birthdate').value = users_arr[i]['user_birthdate'];
          document.getElementById('user_city').value = users_arr[i]['user_city'];
          document.getElementById('user_phone').value = users_arr[i]['user_phone'];
          document.getElementById('user_postion').value = users_arr[i]['user_postion'];
          document.getElementById('user_spec').value = users_arr[i]['user_spec'];
          document.getElementById('user_spec_level').value = users_arr[i]['user_spec_level'];
          document.getElementById('user_contract').value = users_arr[i]['user_contract'];
          document.getElementById('contract_begin').value = users_arr[i]['user_contract_begin'];
          document.getElementById('contract_end').value = users_arr[i]['user_contract_end'];
          document.getElementById('user_login').value = users_arr[i]['user_login'];
          document.getElementById('idUser').value = users_arr[i]['idUser'];
          idCity = users_arr[i]['user_city'];
          ulogin = users_arr[i]['user_login'];
        }
     }

     showUserTrips(idUser, idCity, ulogin);
     // console.log(idUser, idCity);


}

function showUserTrips(idUser, ucity, ulogin){
  // if(trip_table !== 'null' ) {
  //     profile.removeChild(trip_table);
  // }
  //   profile.removeChild(document.getElementsByTagName("table")[0]);

   let user_trips_arr = [];
   // console.log(trips_arr);
   for (let i = 0; i < trips_arr.length; i++) {
     // console.log(trips_arr[i]['idUser'], "////", idUser);
     if (trips_arr[i]['idUser'] == idUser){

       user_trips_arr.push(trips_arr[i]);

     }
   }
      for (let i = 0; i < user_trips_arr.length; i++) {
   console.log(user_trips_arr[i]['ticket']);
 }

   let profile = document.getElementsByName(idUser);
   let trip_table = document.createElement('table');
   trip_table.setAttribute('class','table table-bordered table-sm table-responsive');

   let nom = ['Начало', 'Окончание', 'Город', 'Заказчик', 'Объект','Билет начала', 'Билет окончания'];
   let nom_row = trip_table.insertRow(0);
   for (let i = 0; i < nom.length; i++) {
        let nom_cell = nom_row.insertCell(i);
        nom_cell.innerText = nom[i];
       }
   for (let i=0; i < user_trips_arr.length; i++) {
  	    let row = trip_table.insertRow(i+1);
        let begin = row.insertCell(0);
        let end = row.insertCell(1);
        let tripCity = row.insertCell(2);
        let company = row.insertCell(3);
        let project = row.insertCell(4);
        let ticket1 = row.insertCell(5);
        let ticket2 = row.insertCell(6);
  	    tripCity.innerText = user_trips_arr[i]['proj_city'];
        company.innerText = user_trips_arr[i]['comp_name'];
        project.innerText = user_trips_arr[i]['proj_name'];

        if (user_trips_arr[i]['city'] !== ucity) {
            begin.innerText = getDate(user_trips_arr[i]['ticket_date']);
            end.innerText = 'В командировке';
            if (user_trips_arr[i]['ticket'] === null){
              ticket1.innerText = "Не загружен";
            } else {
              let img1 = document.createElement('img');
              img1.src = "/static/img/" + ulogin + "/" + user_trips_arr[i]['ticket'];
              console.log(img1.src);
              img1.style.cssText = `
                          				width: 50px;
                                  height: 25px;
                                                  `;
              ticket1.appendChild(img1);
            }
        }
        if (user_trips_arr[i]['city'] === ucity) {
            end.innerText = getDate(user_trips_arr[i]['ticket_date']);
            begin.innerText = getDate(user_trips_arr[i+1]['ticket_date']);
            if (user_trips_arr[i+1]['ticket'] === null){
              ticket1.innerText ="Не загружен";
            } else {
              let img1 = document.createElement('img');
              img1.src = "/static/img/" + ulogin + "/" + user_trips_arr[i+1]['ticket'];
              img1.style.cssText = `
                          				width: 50px;
                                  height: 25px;
                                                  `;
              ticket1.appendChild(img1);
            }
            if (user_trips_arr[i]['ticket'] === null){
              ticket2.innerText = "Не загружен";
            } else {
              let img2 = document.createElement('img');
              img2.src = "/static/img/" + ulogin + "/" + user_trips_arr[i]['ticket'];
              img2.style.cssText = `
                          				width: 50px;
                                  height: 25px;
                                                  `;
              ticket2.appendChild(img2);
            }
            i++;
          }
      }
      // if(trip_table !== 'null' ) {
      let tbl = profile[0].getElementsByTagName('table')[0];
      if (tbl) {
        profile[0].removeChild(tbl);
      }

      profile[0].appendChild(trip_table);
}
document.getElementById('user_pwd').setAttribute("class", "invis");
let chPWDbutton = document.getElementById('changePWD');
chPWDbutton.setAttribute("class", "invis");

function changeForm(){
  bShowChange.setAttribute("class", "invis");
  bChUser.setAttribute("class", "btn btn-secondary");
  bRF3.setAttribute("class", "btn btn-primary");
  // document.getElementById('user_pwd').setAttribute("class", "invis");
  chPWDbutton.setAttribute('class','pwdbtn btn-secondary');
  for (let i = 0; i < input_user.length; i++){
    if(![3,10,11,13].includes(i)){
      input_user[i].removeAttribute("readonly");
      input_user[i].setAttribute("class", "border");
    }
  }
  for (let i = 0; i < inp_date_user.length; i++){
      inp_date_user[i].setAttribute("class", "border");
      inp_date_user[i].parentNode.removeAttribute("class");
  }
}

function changePWD(){
    chPWDbutton.setAttribute("class", "invis");
    document.getElementById('user_pwd').setAttribute("class", "border");
    document.getElementById('user_pwd').value = rus_to_latin(sa[Math.round(1 + Math.random() * (sa.length - 1))].toUpperCase()
    + (Math.round(1 + Math.random() * (9 - 1)))
    + sa[Math.round(1 + Math.random() * (sa.length - 1))].toLowerCase()
    + sa[Math.round(1 + Math.random() * (sa.length - 1))].toLowerCase()
    + (Math.round(1 + Math.random() * (9 - 1)))
    + sa[Math.round(1 + Math.random() * (sa.length - 1))].toUpperCase());
}

function changeUser(){
    let change = [];
    change.push(document.getElementById('user_surname').value,
      document.getElementById('user_name').value,
      document.getElementById('user_second_name').value,
      document.getElementById('user_birthdate').value,
      document.getElementById('user_city').value,
      document.getElementById('user_phone').value,
      document.getElementById('user_postion').value,
      document.getElementById('user_spec').value,
      document.getElementById('user_spec_level').value,
      document.getElementById('user_contract').value,
      document.getElementById('user_contract_begin').value,
      document.getElementById('user_contract_end').value,
      document.getElementById('user_login').value,
      document.getElementById('user_pwd').value,
      document.getElementById('idUser').value);

    let change_json = JSON.stringify(change);
    console.log(change);
    let request = new XMLHttpRequest();
    request.open('POST', "/admin/changeuser", true);//this.action
    let FD = new FormData();
    FD.append('change', change_json);
    request.send(FD);

     request.onload = function(){
       console.log(request.responseText);
         if(request.status === 200){
             responseChange(request.responseText);
         }
     }
}

bChUser.addEventListener('click', changeUser);

function responseChange(response){
    if(response == SUCCESSCHANGE)    {
        window.location.replace("/admin/users");
    } else if (response == ERRORCHANGE){
        ans.innerText = ERRORCHANGE;
    }
}

function closeForm(){
    window.location.replace("/admin/users");
    ans.innerText = '';
}

function deleteForm(){
  for (let i = 0; i < checkboxes.length; i++){
    checkboxes[i].parentNode.removeAttribute("class");
  }
    del.removeAttribute("class");

     bAF.setAttribute("class", "invis");
     bDU.setAttribute("class", "btn btn-secondary");
     bRF.setAttribute("class", "btn btn-primary");
     bShowDel.setAttribute("class", "invis");
     showuser.setAttribute("class", "invis");
  }

function showForm() {
     bAF.setAttribute("class", "invis");
     adduser.setAttribute("class", "card col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5");
     showuser.setAttribute("class", "invis");

     bShowDel.setAttribute("class", "invis");

       for (let i = 0; i < input_add.length; i++){
           input_add[i].setAttribute("class", "border size");
      }
      for (let i = 0; i < inp_date_add.length; i++){
          inp_date_add[i].setAttribute("class", "border");
          inp_date_add[i].removeAttribute("readonly");
          inp_date_add[i].parentNode.removeAttribute("class");
      }
      // inps[0].removeAttribute('readonly');
      // inps[0].focus();

      // for (let i = 1; i < inps.length; i++){
      //     if(inps[i-1].value.length > 0){
      //       // inps[i].removeAttribute('readonly');
      //       inps[i].focus();
      //     }
      // }
}

function validate() {
  let infoAdd = document.getElementById('infoAdd');
  infoAdd.setAttribute('class', 'invis');
  for (let i = 0; i < inps.length; i++){
    if (inps[i].value.length < 1){
      let mark = document.createElement('mark');
      mark.innerHTML = 'Заполните все поля формы перед добавлением сотрудника';
      let m1 = infoAdd.getElementsByTagName('mark')[0];
      if (m1) {
        infoAdd.removeChild(m1);
      }
      infoAdd.appendChild(mark);
      infoAdd.removeAttribute('class');
      return false;
    }
  }
  return true;
}

let adduserform = document.forms.adduserform;

function sendForm(event) {
    event.preventDefault();
    if (!validate()){
      return ERROR;
    }
    let request = new XMLHttpRequest();
    request.open('POST', "/admin/adduser", true);//this.action
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

adduserform.addEventListener("submit", sendForm);

function responseHandler(response){
    if(response == SUCCESS){
        window.location.replace("/admin/users");
    } else if (response == ERROR){
        ans.innerText = ERROR;
    }
}

function deleteUser(){
  let ids = [];
    for (let i = 0; i < checkboxes.length; i++) {
      if(checkboxes[i].checked){
          ids.push(checkboxes[i].value);
      }
    }
    let request = new XMLHttpRequest();
    request.open('POST', "/admin/deleteuser", true);//this.action

    let FD = new FormData();
    FD.append('ids', ids);
    request.send(FD);

     request.onload = function(){
       console.log(request.responseText);
       console.log(request.status);

         if(request.status === 200){
             responseDelete(request.responseText);
         }
     }
}

bDU.addEventListener('click', deleteUser);

function responseDelete(response){
    if(response == SUCCESSDEL){
        window.location.replace("/admin/users");
    } else if (response == ERRORDEL){
        ans.innerText = ERRORDEL;
    }
}


function rus_to_latin (str) {
    let ru = {
        'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd',
        'е': 'e', 'ё': 'e', 'ж': 'j', 'з': 'z', 'и': 'i',
        'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o',
        'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u',
        'ф': 'f', 'х': 'h', 'ц': 'c', 'ч': 'ch', 'ш': 'sh',
        'щ': 'shch', 'ы': 'y', 'э': 'e', 'ю': 'u', 'я': 'ya'
    }, n_str = [];

    str = str.replace(/[ъь]+/g, '').replace(/й/g, 'i');

    for ( let i = 0; i < str.length; ++i ) {
       n_str.push(
              ru[ str[i] ]
           || ru[ str[i].toLowerCase() ] == undefined && str[i]
           || ru[ str[i].toLowerCase() ].replace(/^(.)/, function ( match ) { return match.toUpperCase() })
       );
    }

    return n_str.join('');
}

// function getCity() {
// console.log(document.getElementById("user_city1").value);
// return document.getElementById("user_city1").value;
// }
//
let login = document.getElementById('user_login1');
let pwd = document.getElementById('user_pwd1');
let name = document.getElementById('user_name1');
let surname = document.getElementById('user_surname1');
let arr_login = [];
let arr_pwd = [];

function getName(){
  // console.log(login);
  // console.log(rus_to_latin(document.getElementById("user_surname1").value));
  name.value = document.getElementById("user_name1").value.charAt(0).toUpperCase() +  document.getElementById("user_name1").value.substr(1);
  login.value ='';

  // login.value =  rus_to_latin(document.getElementById("user_name1").value).charAt(0) + '.';
  arr_login[0] = rus_to_latin(document.getElementById("user_name1").value).charAt(0) + '.';
  document.getElementById("user_surname1").focus();
  }
function getSurname(){
  surname.value = document.getElementById("user_surname1").value.charAt(0).toUpperCase() +  document.getElementById("user_surname1").value.substr(1);
  login.value = arr_login[0] + rus_to_latin(document.getElementById("user_surname1").value);
  // document.getElementById("user_second_name1").focus();

  pwd.value = rus_to_latin(sa[Math.round(1 + Math.random() * (sa.length - 1))].toUpperCase()
  + (Math.round(1 + Math.random() * (9 - 1)))
  + sa[Math.round(1 + Math.random() * (sa.length - 1))].toLowerCase()
  + sa[Math.round(1 + Math.random() * (sa.length - 1))].toLowerCase()
  + (Math.round(1 + Math.random() * (9 - 1)))
  + sa[Math.round(1 + Math.random() * (sa.length - 1))].toUpperCase());
}
