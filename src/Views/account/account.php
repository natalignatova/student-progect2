<?  $json_projects = json_encode($data['projects'], JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
$arr=[];
?>

<script>
let user_city = '<? echo $user['user_city']; ?>';
let proj = '<? echo $json_projects; ?>';
let proj_arr = JSON.parse(proj);
// console.log(proj_arr);
</script>

<div class="flex-row flex-column-xs">

  <div class="flex-column flex-1 border box">
    <div>
      <p><? echo $user['user_name']; ?>, добавьте данные о новой поездке </p>
    </div>
    <div class='flex-column'>
      <form action="/account/addTrip" method="post" enctype="multipart/form-data" name="trip">
        <div class='flex-column'>
          <p>
            <label for="city">Выберите город поездки </label>
          </p>
            <select id="city" name="city" onchange='getProjects()'>
                <!-- <option disabled></option> -->
                <? foreach ($data['projects'] as $project):
                   if (!in_array($project['proj_city'], $arr)) {
                    $arr[] = $project['proj_city'];
                  ?>
                    <option>
                      <?  echo $project['proj_city'];  } ?>
                    </option>
                <? endforeach; ?>
                <option><? echo $user['user_city']; ?></option>
            </select>
        </div>
        <div class='flex-column'>
          <p>
              <label for="idProject">Выберите объект командировки</label>
          </p>
            <select id="idProject" name="idProject">
                <!-- <option disabled></option> -->
                <?php foreach ($data['projects'] as $project) :?>
                <option value='<? echo $project['idProject']; ?>'><? echo $project['comp_name'] . '. ' .$project['proj_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class='flex-column'>
            <p>
                <label for="ticket_date">Дата начала поездки: </label>
            </p>
                <!-- <p class="errors"></p> -->
                <input type="date" id="ticket_date" name="ticket_date">
        </div>
        <div class='flex-column'>
           <p>
              <label class='up' for="ticket">Загрузите фото билета: </label>
          </p>
            <input type="file" id="ticket" name="ticket" accept="image/*"/>
        </div>
        <div class="flex-row">
            <input type="submit" value="Отправить" class="button">
            <input type="reset" value="Отменить" class="button">
        </div>
      </div>
    </form>
  </div>

  <div class="flex-column-r flex-1 box">
    <? foreach ($data['user_trips'] as $trip):
      if ( $user['idUser'] === $trip['idUser']){
       if ($trip['ticket'] === null) {
         $trip_data = $trip['idUserTrip'] . " " . date("Y-m-d",strtotime($trip['ticket_date'])) . " " . $trip['city']?>
          <p><? echo $user['user_name']; ?>,<br/>
          добавьте фото билета <br/></p>
          <p><span><? echo $trip['city'] ?> - <? echo date("d.m.Y",strtotime($trip['ticket_date']))?></span>,</p>
          <p>объект: "<span><? echo $trip['comp_name'] .'. ' .
           $trip['proj_city'] .'. ' . $trip['proj_name']?>"</span></p>
           <div class="flex-row flex-column-xs box">
              <input id='addTicket<? echo $trip['idUserTrip']?>' type="file" name="ticket" accept="image/*"/>
            <div class='button2'>
              <p>
                <a  href="javascript:void(0)" onclick="addUserTicket('<? echo $trip_data?>')">Добавить билет</a>
              </p>
            </div>
           </div>
           <p class='box'><span id = 'error<? echo $trip['idUserTrip']?>'></span></p>
    <? } } endforeach; ?>
  </div>

</div>
<p id = 'ans'></p>

<script src="/static/js/trip.js"></script>
