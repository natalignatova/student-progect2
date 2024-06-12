
const SUCCESS = "Добавлено";
const ERROR = "Не добавлено";

const SUCCESSDEL = "Удалено";
const ERRORDEL = "Не удалено";

const SUCCESSCHANGE = "Изменено";
const ERRORCHANGE = "Не изменено";

let ans = document.getElementById('ans');

let del_ch = document.getElementById('delete_change');
del_ch.setAttribute("class", "invis");

let date_ch = document.getElementById('date_change');
date_ch.setAttribute("class", "invis");
let date_now = document.getElementById('date_now');


let addnews = document.forms.addnews;
// let delnews = document.forms.deletenews;
// let changenews = document.forms.changenews;
// console.log(addnews);
// console.log(delnews);

let checkboxes = document.querySelectorAll('input[type="checkbox"]');
for (let i = 0; i < checkboxes.length; i++) {
  checkboxes[i].parentNode.setAttribute("class", "invis");
}

let textarea = document.querySelectorAll('textarea');
for (let i = 0; i < textarea.length; i++) {
  textarea[i].setAttribute("readonly", true);
}

let date = document.querySelectorAll('input[type="date"]');
for (let i = 0; i < date.length; i++) {
  date[i].parentNode.setAttribute("class", "invis");
  date[i].setAttribute("readonly", true);
}

let bAF = document.getElementById('showAddForm');
let bSN = document.getElementById('sendFormNews');
let bRF = document.getElementById('resetForm');
let bRF2 = document.getElementById('resetForm2');
let sAN = document.getElementById('stringAddNews');


bRF.setAttribute("class", "invis");
bRF2.setAttribute("class", "invis");
bSN.setAttribute("class", "invis");

let bShowDel = document.getElementById('showDeleteForm');
let bDelNews = document.getElementById('DeleteFormNews');
bDelNews.setAttribute("class", "invis");

let bShowChange = document.getElementById('showChangeForm');
let bChNews = document.getElementById('ChangeFormNews');
bChNews.setAttribute("class", "invis");


function showForm() {
     sAN.removeAttribute("class");
     bSN.setAttribute("class", "btn btn-secondary");
     bRF2.setAttribute("class", "btn btn-primary");
     bAF.setAttribute("class", "invis");
     bShowDel.setAttribute("class", "invis");
     bShowChange.setAttribute("class", "invis");

       for (let i = textarea.length-2; i < textarea.length; i++) {
       textarea[i].removeAttribute("readonly",);
       textarea[i].setAttribute("class", "border");
     }

       date[date.length-1].parentNode.removeAttribute("class");
       date[date.length-1].setAttribute("class", "border");
       date[date.length-1].removeAttribute("readonly");
}


function deleteForm()
{
  for (let i = 0; i < checkboxes.length; i++)
  {
    checkboxes[i].parentNode.removeAttribute("class");
  }
      del_ch.innerHTML = "Удалить";
      del_ch.removeAttribute("class");

     bAF.setAttribute("class", "invis");
     bDelNews.setAttribute("class", "btn btn-secondary");
     bRF.setAttribute("class", "btn btn-primary");
     bShowDel.setAttribute("class", "invis");
     sAN.setAttribute("class", "invis");
     bShowChange.setAttribute("class", "invis");
}

function changeForm(){
  for (let i = 0; i < checkboxes.length; i++)  {
      checkboxes[i].parentNode.removeAttribute("class");
  }
  del_ch.innerHTML = "Изменить";
  del_ch.removeAttribute("class");

  for (let i = 0; i < date.length; i++){
  date[i].parentNode.removeAttribute("class");
  }

     date_ch.innerHTML = "Выбрать новую дату";
     date_ch.removeAttribute("class");

     bAF.setAttribute("class", "invis");
     bDelNews.setAttribute("class", "invis");
     bRF.setAttribute("class", "btn btn-primary");
     bShowDel.setAttribute("class", "invis");
     sAN.setAttribute("class", "invis");
     bShowChange.setAttribute("class", "invis");
     bChNews.setAttribute("class", "btn btn-secondary");
}

function checkedChange(){
  for (let i = 0; i < checkboxes.length; i++)
  {
    if(checkboxes[i].checked) {
      textarea[i+i].removeAttribute("readonly");
      textarea[i+i].setAttribute("class", "border");
      textarea[i+i+1].removeAttribute("readonly");
      textarea[i+i+1].setAttribute("class", "border");

      date[i].setAttribute("class", "border");
      date[i].removeAttribute("readonly");
    }

    if(!checkboxes[i].checked){
      textarea[i+i].setAttribute("readonly", true);
      textarea[i+i].removeAttribute("class");
      textarea[i+i+1].setAttribute("readonly", true);
      textarea[i+i+1].removeAttribute("class");

      date[i].removeAttribute("class");
      date[i].setAttribute("readonly", true);
    }
  }
}

function closeForm(){
    window.location.replace("/admin/news");
    ans.innerText = '';
}

function sendForm(event)
{
    event.preventDefault();

    let request = new XMLHttpRequest();
    request.open('POST', "/admin/addnews", true);//this.action

    let FD = new FormData(this);
    request.send(FD);

    // for(let pair of FD.entries()) {
    //    console.log(pair[0]+ ', '+ pair[1]);
     // }
    request.onload = function()
    {
      console.log(request.responseText);

        if(request.status === 200)
        {
            responseHandler(request.responseText);
        }
    }
}

function responseHandler(response)
{
    if(response == SUCCESS)
    {
        window.location.replace("/admin/news");
    } else if (response == ERROR)
    {
        ans.innerText = ERROR;
    }
}

addnews.addEventListener("submit", sendForm);


function changeNews(){
    let change = [];
    for (let i = 0; i < checkboxes.length; i++){
      if(checkboxes[i].checked){
        change.push([checkboxes[i].value, textarea[i+i].value, textarea[i+i+1].value, date[i].value]);
      }
    }
    let change_json = JSON.stringify(change);
    // console.log(change);
    let request = new XMLHttpRequest();
    request.open('POST', "/admin/changenews", true);//this.action
    let FD = new FormData();
    FD.append('change', change_json);
    request.send(FD);
    // for(let pair of FD.entries()) {
    //    console.log(pair[0]+ ', '+ pair[1]);
    //  }
     request.onload = function()
     {
       console.log(request.responseText);
         if(request.status === 200)
         {
             responseChange(request.responseText);
         }
     }
}

bChNews.addEventListener('click', changeNews);

function responseChange(response){
    if(response == SUCCESSCHANGE){
        window.location.replace("/admin/news");
    } else if (response == ERRORCHANGE){
        ans.innerText = ERRORCHANGE;
    }
}

  // let childs = div_change[0].children;
  // console.log(childs[0]);

  function deleteNews(){
    let ids = [];
      for (let i = 0; i < checkboxes.length; i++){
        if(checkboxes[i].checked){
          // console.log(checkboxes[i].value);
          ids.push(checkboxes[i].value);
        }
      }
      let request = new XMLHttpRequest();
      request.open('POST', "/admin/deletenews", true);//this.action

      let FD = new FormData();
      FD.append('ids', ids);
      request.send(FD);

      // for(let pair of FD.entries()) {
      //    console.log(pair[0]+ ', '+ pair[1]);
      //  }
       request.onload = function(){
         // console.log(request.responseText);

           if(request.status === 200){
               responseDelete(request.responseText);
           }
       }
  }

  bDelNews.addEventListener('click', deleteNews);

  function responseDelete(response){
      if(response == SUCCESSDEL){
          window.location.replace("/admin/news");
      } else if (response == ERRORDEL){
          ans.innerText = ERRORDEL;
      }
  }
