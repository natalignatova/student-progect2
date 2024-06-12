<?  $json_user = json_encode($users, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
$json_trips = json_encode($trips, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
// var_dump($json_user);
?>

<script>
let users = '<? echo $json_user; ?>';
let users_arr = JSON.parse(users);
// console.log(users_arr);
let trips = '<? echo $json_trips; ?>';
let trips_arr = JSON.parse(trips);
// console.log(trips_arr);
</script>

<div class="flex-row text-right margin">
  <input id='showAddForm' class="btn btn-secondary" type="button" onclick="showForm()" value="Добавить сотрудника">
  <!-- <input id='showChangeForm' class="btn btn-secondary" type="button" onclick="changeForm()" value="Изменить данные">
  <input id='ChangeFormNews' type="button" value="Изменить"> -->
  <input id='showDeleteForm' class="btn btn-secondary" type="button" onclick="deleteForm()" value="Удалить данные">

  <p id='ans'> </p>

</div>

<div class="row col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
      <div class="flex-row text-right margin">
            <input id='DeleteFormUser' type="button" value="Удалить">
            <input id='resetForm' onclick="closeForm()" type="reset"  value="Отменить">
      </div>
        <div class="card">
          <div class="card-header">
              <h5 class="mb-0"><? echo $page_title; ?></h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered second" style="width:100%">
                <thead>
                    <tr>
                        <th>Ф.И.О.</th>
											  <th>Должность</th>
                        <th>Специальность</th>
                        <th>Разряд</th>
                        <th id='del'>Удалить данные</th>
						       </tr>
                </thead>
                <tbody>
                  <?php foreach ($users as $user) :?>
                  <tr>
                      <th><a href="javascript:void(0)" onclick="showUser(<? echo $user['idUser'];?>)">
                        <? echo $user['user_surname'] . ' ' . $user['user_name'] . ' ' . $user['user_second_name'];?>
                      </a></th>
                      <th><? echo $user['user_postion'];?></th>
                      <th><? echo $user['user_spec'];?></th>
                      <th><? echo $user['user_spec_level'];?></th>
                      <th ><input type="checkbox" value="<? echo $user['idUser'];?>" name="idUser[]"></th>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
            </table>
        </div>
      </div>
      </div>
      </div>
                                      <!--  добавить сотрудника-->


<div id="adduser" class="card col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">
  <div class="card-header">
      <h5 class="mb-0">Добавить сотрудника</h5>
  </div>
  <form  action="/admin/adduser" method="post" name="adduserform" class="adduser">
      <table border="0">
            <tr>
               <td><label for="user_name">Имя</label></td>
               <td><input id="user_name1" name="user_name1" type="text" placeholder="Введите имя" onchange="getName()"></td>
           </tr>
           <tr>
              <td><label for="user_surname">Фамилия</label></td>
              <td><input id="user_surname1" name="user_surname1" type="text" placeholder="Введите фамилию" onmouseout="getSurname()"> </td>
           </tr>
           <tr>
               <td><label for="user_second_name">Отчество</label></td>
               <td><input id="user_second_name1" name="user_second_name1" type="text" placeholder="Введите отчество"></td>
           </tr>
           <tr>
              <td><label for="user_birthdate">Дата рождения</label></td>
              <td><input  type="date" id="user_birthdate1" name="user_birthdate1" /></td>
           </tr>
           <tr>
              <td><label for="user_city">Город проживания</label></td>
              <td><input id="user_city1" name="user_city1" type="text" placeholder="Введите город проживания"></td>
          </tr>
          <tr>
              <td><label for="user_phone">Номер телефона</label></td>
              <td><input id="user_phone1" name="user_phone1" type="text" placeholder="8ХХХХХХХХХХ"></td>
          </tr>
          <tr>
              <td><label for="user_position">Должность</label></td>
              <td><input id="user_position1" name="user_position1" type="text" placeholder="Введите должность"></td>
          </tr>
          <tr>
              <td><label for="user_spec">Специальность</label></td>
              <td><input id="user_spec1" name="user_spec1" type="text" placeholder="Введите специальность"></td>
          </tr>
          <tr>
              <td><label for="user_spec_level">Разряд</label></td>
              <td><input id="user_spec_level1" name="user_spec_level1" type="text" placeholder="Введите разряд"></td>
          </tr>
          <tr>
              <td><label for="user_contract">Номер контракта</label></td>
              <td><input id="user_contract1" name="user_contract1" type="text" placeholder="Введите номер контракта"></td>
          </tr>
          <tr>
               <td><label for="user_contract_begin">Начало контракта</label></td>
               <td><input  type="date" id="user_contract_begin1" name="user_contract_begin1"></td>
          </tr>
          <tr>
               <td><label for="user_contract_end">Окончание контракта</label></td>
               <td><input  type="date" id="user_contract_end1" name="user_contract_end1"></td>
           </tr>
           <tr>
              <td><label for="user_login">Логин</label></td>
              <td><input id="user_login1" name="user_login1" type="text" placeholder="Логин"></td>
          </tr>
          <tr>
              <td><label for="user_pwd">Пароль</label></td>
              <td><input id="user_pwd1" name="user_pwd1" type="text" placeholder="Пароль"></td>
          </tr>
      </table>
      <h3 id='infoAdd'></h3>
   <div class="flex-row">
      <p id = 'ans'></p>
      <!-- <input class="btn btn-secondary" type="button" onclick="showForm()" value="Изменить"> -->
      <input id='sendFormUser' class="btn btn-secondary" type="submit" value="Добавить">
      <input id='resetForm2' class="btn btn-primary" onclick="closeForm()" type="reset" value="Отменить">
  </div>
</form>
</div>


<div id="showuser" class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">
    <div class="tab-regular">
        <ul class="nav nav-tabs " id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                aria-controls="home" aria-selected="true"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Командировки</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"></a>
            </li> -->
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <!-- <form  action="/userchanges" method="post" name="userchanges" class="userchanges"> -->
                    <table border="0">
						             <tr>
							               <td><label for="user_surname">Фамилия</label></td>
							               <td><input id="user_surname" name="user_surname" type="text" placeholder="Фамилия" value=""> </td>
						             </tr>
						             <tr>
							               <td><label for="user_name">Имя</label></td>
							               <td><input id="user_name" name="user_name" type="text" placeholder="Имя" value=""></td>
						             </tr>
                         <tr>
							               <td><label for="user_second_name">Отчество</label></td>
							               <td><input id="user_second_name" name="user_second_name" type="text" placeholder="Отчество" value=""></td>
						             </tr>
						             <tr>
            	              <td><label for="user_birthdate">Дата рождения</label></td>
							              <td><input  type="date" id="user_birthdate" name="user_birthdate"></td>
                            <td><input  type="text" id="birthdate" name="birthdate" placeholder="Дата рождения" value=""></td>
						             </tr>
                         <tr>
                            <td><label for="user_city">Город проживания</label></td>
                            <td><input id="user_city" name="user_city" type="text" placeholder="Город проживания" value=""></td>
                        </tr>
                        <tr>
                            <td><label for="user_phone">Номер телефона</label></td>
                            <td><input id="user_phone" name="user_phone" type="text" placeholder="Номер телефона" value=""></td>
                        </tr>
                        <tr>
                            <td><label for="user_postion">Должность</label></td>
                            <td><input id="user_postion" name="user_postion" type="text" placeholder="Должность" value=""></td>
                        </tr>
                        <tr>
                            <td><label for="user_spec">Специальность</label></td>
                            <td><input id="user_spec" name="user_spec" type="text" placeholder="Специальность" value=""></td>
                        </tr>
                        <tr>
                            <td><label for="user_spec_level">Разряд</label></td>
                            <td><input id="user_spec_level" name="user_spec_level" type="text" placeholder="Разряд" value=""></td>
                        </tr>
                        <tr>
                            <td><label for="user_contract">Номер контракта</label></td>
                            <td><input id="user_contract" name="user_contract" type="text" placeholder="Номер контракта" value=""></td>
                        </tr>
                        <tr>
            	               <td><label for="user_contract_begin">Начало контракта</label></td>
    							           <td><input  type="date" id="user_contract_begin" name="user_contract_begin"></td>
                            <td> <input  type="text" id="contract_begin" name="contract_begin" placeholder="Начало контракта" value="" ></td>
						            </tr>
                        <tr>
            	               <td><label for="user_contract_end">Окончание контракта</label></td>
							               <td><input  type="date" id="user_contract_end" name="user_contract_end"></td>
                             <td><input type="text" id="contract_end" name="contract_end" placeholder="-" value=""></td>
						             </tr>
                         <tr>
                            <td><label for="user_login">Логин</label></td>
                            <td><input id="user_login" name="user_login" type="text" placeholder="Логин" value=""></td>
                        </tr>
                        <tr>
                            <td><label for="user_pwd">Пароль</label></td>
                            <td><input id='changePWD' type="button" value="Получить новый пароль" onclick="changePWD()"><input id="user_pwd" name="user_pwd" type="text" placeholder="Пароль" value=""></td>
                        </tr>
                        <tr class='invis'>
                            <td><label  for="idUser">ID</label></td>
                            <td> <input id="idUser" name="idUser" type="text" placeholder="ID" value=""></td>
                      </tr>
					       </table>
                 <div class="flex-row">
                    <input id='showChangeForm' class="btn btn-secondary" type="button" onclick="changeForm()" value="Изменить данные">
                    <!-- <input id='ChangeFormUser' type="submit" value="Изменить"> -->
                    <input id='ChangeFormUser' type="button" value="Изменить">
                    <input id='resetForm3' type="reset"  value="Отменить" onclick="closeForm()">
                    <p id = 'ans'></p>
                 </div>
            <!-- </form> -->
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

          </div>
          <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

          </div> -->
        </div>
    </div>
  </div>
</div>






<script src="/static/js/users.js"></script>
