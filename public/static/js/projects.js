const SUCCESS = "Добавлено";
const ERROR = "Не добавлено";

const SUCCESSDEL = "Удалено";
const ERRORDEL = "Не удалено";

const SUCCESSCHANGE = "Изменено";
const ERRORCHANGE = "Не изменено";


let ans = document.getElementById('ans');

let addForm = document.forms.addform;

let bShowAddForm = document.getElementById('showAddForm');
let bShowChange = document.getElementById('showChangeForm');
let bShowDel = document.getElementById('showDeleteForm');
let bResetForm = document.getElementById('resetForm');
bResetForm.setAttribute("class", "invis");

let bDeleteForm = document.getElementById('DeleteForm');
bDeleteForm.setAttribute("class", "invis");
let delOff = document.getElementsByClassName('delOff');

let bChangeForm = document.getElementById('ChangeForm');
bChangeForm.setAttribute("class", "invis");

let bSendForm = document.getElementById('sendForm');
bSendForm.setAttribute("class", "invis");
let bResetForm2 = document.getElementById('resetForm2');
bResetForm2 .setAttribute("class", "invis");

let addDiv = document.getElementById('add');
// console.log(addDiv);

let textAdd = addDiv.querySelectorAll('textarea');
let inputAdd = addDiv.querySelectorAll('input');

let changeDiv = document.getElementById('changeDiv');
// console.log(addDiv);

let textCh = changeDiv.querySelectorAll('textarea');
// console.log(textCh);
let dateCh = changeDiv.querySelectorAll('input[type="date"]');
// console.log(dateCh);
let imgCh = changeDiv.querySelectorAll('input[type="file"]');
// console.log(imgCh);
let selCh = changeDiv.getElementsByTagName('select')
// console.log(textAdd, dateAdd);
let checkboxes = document.querySelectorAll('input[type="checkbox"]');
for (let i = 0; i < checkboxes.length; i++) {
  checkboxes[i].parentNode.setAttribute("class", "invis");
}

function closeForm(){
    window.location.replace("/admin/projects");
    ans.innerText = '';
}

function showForm() {
     addDiv.removeAttribute("class");
     bSendForm.setAttribute("class", "btn btn-secondary");
     bResetForm2.setAttribute("class", "btn btn-primary");
     bShowAddForm.setAttribute("class", "invis");
     bShowDel.setAttribute("class", "invis");
     bShowChange.setAttribute("class", "invis");

       for (let i = 0; i < textAdd.length; i++) {
       textAdd[i].setAttribute("class", "border");
     }
       for (let i = 0; i < inputAdd.length; i++) {
       inputAdd[i].setAttribute("class", "border inputwidth");
     }
}
function sendForm(event){
    event.preventDefault();
    let request = new XMLHttpRequest();
    request.open('POST', "/admin/addproject", true);//this.action
    let FD = new FormData(this);
    request.send(FD);
    request.onload = function(){
        if(request.status === 200){
            responseHandler(request.responseText);
        }
    }
}

function responseHandler(response){
    if(response == SUCCESS)    {
        window.location.replace("/admin/projects");
    } else if (response == ERROR){
        ans.innerText = ERROR;
    }
}

addForm.addEventListener("submit", sendForm);

function deleteForm(){
  for (let i = 0; i < checkboxes.length; i++){
    checkboxes[i].parentNode.removeAttribute("class");
  }

  bShowAddForm.setAttribute("class", "invis");
  bShowDel.setAttribute("class", "invis");
  bShowChange.setAttribute("class", "invis");

  document.getElementById('del-ch').removeAttribute("class");
  document.getElementById('del-ch').innerHTML = "Удалить";

  bDeleteForm.setAttribute("class", "btn btn-secondary");
  bResetForm.setAttribute("class", "btn btn-primary");

  }

  function deleteProject(){
    let ids = [];
      for (let i = 0; i < checkboxes.length; i++){
        if(checkboxes[i].checked)        {
          console.log(checkboxes[i].value);
          ids.push(checkboxes[i].value);
        }
      }
      console.log(ids);
      let request = new XMLHttpRequest();
      request.open('POST', "/admin/deleteprojects", true);//this.action

      let FD = new FormData();
      FD.append('ids', ids);
      request.send(FD);
       request.onload = function(){
         console.log(request.responseText);
           if(request.status === 200){
               responseDelete(request.responseText);
           }
       }
  }

  bDeleteForm.addEventListener('click', deleteProject);

  function responseDelete(response){
      if(response == SUCCESSDEL){
          window.location.replace("/admin/projects");
      } else if (response == ERRORDEL){
          ans.innerText = ERRORDEL;
      }
  }

  function changeForm(){
    for (let i = 0; i < checkboxes.length; i++)  {
        checkboxes[i].parentNode.removeAttribute("class");
    }
    bShowAddForm.setAttribute("class", "invis");
    bShowDel.setAttribute("class", "invis");
    bShowChange.setAttribute("class", "invis");

    document.getElementById('del-ch').removeAttribute("class");
    document.getElementById('del-ch').innerHTML = "Изменить";

    bChangeForm.setAttribute("class", "btn btn-secondary");
    bResetForm.setAttribute("class", "btn btn-primary");
  }

  function changeProjects(){
      let change = [];
      for (let i = 0; i < checkboxes.length; i++){
        if(checkboxes[i].checked){
          change.push([checkboxes[i].value, textCh[i*5].value, textCh[i*5+1].value, textCh[i*5+2].value, textCh[i*5+3].value, textCh[i*5+4].value,
             dateCh[i*2].value, dateCh[i*2+1].value, selCh[i].value]);
        }
      }
      let change_json = JSON.stringify(change);
      // console.log(change);
      let request = new XMLHttpRequest();
      request.open('POST', "/admin/changeprojects", true);//this.action
      let FD = new FormData();
      FD.append('change', change_json);
      for (let i = 0; i < checkboxes.length; i++){
        if(checkboxes[i].checked){
          FD.append('proj_pic'+checkboxes[i].value, imgCh[i].files[0]);
        }
      }
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

  bChangeForm.addEventListener('click', changeProjects);

  function responseChange(response){
      if(response == SUCCESSCHANGE){
          window.location.replace("/admin/projects");
      } else if (response == ERRORCHANGE){
          ans.innerText = ERRORCHANGE;
      }
  }

  function checkedChange(){
    for (let i = 0; i < checkboxes.length; i++){
      if(checkboxes[i].checked){
        textCh[i*5].removeAttribute("readonly");
        textCh[i*5].setAttribute("class", "border");
        textCh[i*5+1].removeAttribute("readonly");
        textCh[i*5+1].setAttribute("class", "border");
        // textCh[i*5+2].removeAttribute("readonly");
        // textCh[i*5+2].setAttribute("class", "border");
        textCh[i*5+3].removeAttribute("readonly");
        textCh[i*5+3].setAttribute("class", "border");
        textCh[i*5+4].removeAttribute("readonly");
        textCh[i*5+4].setAttribute("class", "border");

        dateCh[i*2].setAttribute("class", "border");
        dateCh[i*2+1].setAttribute("class", "border");
        imgCh[i].setAttribute("class", "border inputwidth");
        selCh[i].removeAttribute("class");
        document.getElementsById('navbar').removeAttribute('class');
        document.getElementsById('navbar').setAttribute('class', 'nav-left-sidebar-cd sidebar-dark');
        // console.log(document.getElementsById('navbar'));
        document.getElementsById('mainbox').removeAttribute('class');
        document.getElementsById('mainbox').setAttribute('class', 'dashboard-wrapper-cd');
        // console.log(document.getElementsById('mainbox'));
      }

      if(!checkboxes[i].checked){
        textCh[i*5].removeAttribute("class");
        textCh[i*5].setAttribute("readonly", true);
        textCh[i*5+1].removeAttribute("class");
        textCh[i*5+1].setAttribute("readonly", true);
        // textCh[i*5+2].removeAttribute("class");
        // textCh[i*5+2].setAttribute("readonly", true);
        textCh[i*5+3].removeAttribute("class");
        textCh[i*5+3].setAttribute("readonly", true);
        textCh[i*5+4].removeAttribute("class");
        textCh[i*5+4].setAttribute("readonly", true);

        dateCh[i*2].setAttribute("class", "invis");
        dateCh[i*2+1].setAttribute("class", "invis");
        imgCh[i].setAttribute("class", "invis");
        selCh[i].setAttribute("class", "invis");
        document.getElementsById('navbar').setAttribute('class', 'nav-left-sidebar sidebar-dark');
        // console.log(document.getElementsById('navbar'));
        document.getElementsById('mainbox').setAttribute('class', 'dashboard-wrapper');
      }
    }
  }
