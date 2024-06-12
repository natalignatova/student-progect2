<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

  <div class="flex-row text-right margin">
    <a href="#add">
       <input id='showAddForm' class="btn btn-secondary" type="button" onclick="showForm()" value="Добавить проект">
    </a>

    <input id='showDeleteForm' class="btn btn-secondary" type="button" onclick="deleteForm()" value="Удалить проект">
    <input id='DeleteForm' type="button" value="Удалить">

    <input id='showChangeForm' class="btn btn-secondary" type="button" onclick="changeForm()" value="Изменить проект">
    <input id='ChangeForm' type="button" value="Изменить">

    <input id='resetForm' onclick="closeForm()" type="reset"  value="Отменить">
    <p id='ans'> </p>

  </div>

  <div class="card">
     <div class="card-body">
       <table  width="100%" class="table">
         <thead>
           <tr id='change'>
             <th >Наименование объекта</th>
             <th >Город</th>
             <th >Заказчик</th>
             <th >Описание</th>
             <th style="width: 6rem">Номер контракта</th>
             <!-- <th class="invis">Корректировать дату начала</th> -->
             <th style="width: 6rem">Начало работ</th>
             <!-- <th class="invis">Корректировать дату окончания</th> -->
             <th style="width: 6rem">Окончание работ</th>
             <!-- <th class="invis">Загрузить новое фото</th> -->
             <th >Фото</th>
             <!-- <th class='invis'>Корректировать отображение на сайте</th> -->
             <th >Отображение <br /> на сайте</th>
             <th id='del-ch' class="invis"></th>
           </tr>
         </thead>
         <tbody id='changeDiv'>
           <?php foreach ($projects as $project) :?>
           <tr >
               <th><textarea cols="15" rows="4" name='proj_name' readonly> <? echo $project['proj_name'];?></textarea></th>
               <th><textarea cols="10" rows="4" name='proj_city' readonly><? echo $project['proj_city'];?></textarea></th>
               <th><textarea cols="9" rows="4" name='comp_name' readonly><? echo $project['comp_name'];?></textarea></th>
               <th><textarea cols="30" rows="4" name='proj_desc' readonly><? echo $project['proj_desc'];?></textarea></th>
               <th><textarea cols="8" rows="4" name='proj_contract' readonly><? echo $project['proj_contract'];?></textarea></th>
               <th class='flex-column'><input class='invis' type="date" name='proj_date_begin'>
               <p><? echo $project['proj_date_begin'];?></p></th>
               <th class='flex-column'><input class='invis' type="date" name='proj_date_end'>
               <p><? echo $project['proj_date_end'];?></p></th>
               <th class='flex-column'> <input class='invis' type='file' name="proj_pic<? echo $project['idProject'];?>" accept="image/*"/>
              <div><img width="50" height="25" src="/static/img/<? echo $project['comp_name'];?>/<? echo $project['proj_pic'];?>"> </div></th>
               <th id='proj_on_site' class="flex-column">
                  <select name="proj_on_site" class='invis'>
                      <option value="нет">Нет</option>
                      <option value="да">Да</option>
                  </select>
               <p><? echo $project['proj_on_site'];?></p></th>
               <th class='invis'><input type="checkbox" value="<? echo $project['idProject'];?>" name="idProject[]" onchange="checkedChange()"></th>
           </tr>
           <?php endforeach; ?>
           <tr id='add' class='invis'>
             <form action='/admin/addproject' method="post" name='addform'>
               <th><textarea cols="15" rows="5" name='proj_name'>Проект</textarea> </th>
               <th><textarea cols="10" rows="5" name='proj_city'>Город </textarea></textarea> </th>
               <th><textarea cols="9" rows="5" name='comp_name'>Компания </textarea></textarea> </th>
               <th><textarea cols="30" rows="5" name='proj_desc'>Описание проекта </textarea></th>
               <th><textarea cols="8" rows="5" name='proj_contract'>Номер контракта</textarea></th>
               <th><input type="date" name='proj_date_begin'></th>
               <th><input type="date" name='proj_date_end'></th>
               <th class='flex-column'><p>Фото </p><input type='file' name="proj_pic" accept="image/*"/></th>
               <th>
                  <select name="proj_on_site">
                      <option value="нет">Нет</option>
                      <option value="да">Да</option>
                  </select>
               </th>
          </tr>
          </tbody>
        </table>

      </div>
    </div>
  </div>
  <div class="flex-row text-right">
    <input id='sendForm'  type="submit" value="Добавить">
    <input id='resetForm2' onclick="closeForm()" type="reset"  value="Отменить">

  </div>
 </form>
<script src="/static/js/projects.js"></script>
