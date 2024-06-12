<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

  <div class="flex-row text-right margin">
    <a href="#add">
       <input id='showAddForm' class="btn btn-secondary" type="button" onclick="showForm()" value="Добавить услугу">
    </a>

    <input id='showDeleteForm' class="btn btn-secondary" type="button" onclick="deleteForm()" value="Удалить услугу">
    <input id='DeleteForm' type="button" value="Удалить">

    <input id='showChangeForm' class="btn btn-secondary" type="button" onclick="changeForm()" value="Изменить услугу">
    <input id='ChangeForm' type="button" value="Изменить">

    <input id='resetForm' onclick="closeForm()" type="reset"  value="Отменить">
    <p id='ans'> </p>

  </div>

  <div class="card">
     <div class="card-body">
       <table class="table">
         <thead>
           <tr>
             <th>Услуга</th>
             <th>Описание</th>
             <th>Фото на сайт</th>
          </tr>
         </thead>
         <tbody>
           <?php foreach ($services as $service) :?>
           <tr>
               <th><? echo $service['serv_name'];?></th>
               <th><? echo $service['serv_desc'];?></th>
               <th> <img width="70" height="35" src="/static/img/<? echo $service['serv_pic'];?>"> </th>
          </tr>
           <?php endforeach; ?>
         </tbody>
       </table>
     </div>
   </div>
 </div>

 <!-- <div class="flex-row text-right">
   <input id='sendFormNews'  type="submit" value="Добавить">
   <input id='resetForm2' onclick="closeForm()" type="reset"  value="Отменить">
 </div> -->
<script src="/static/js/serv.js"></script>
