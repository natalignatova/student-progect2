<!-- <p class="contacts"> Офис ООО "Лемминг Групп" находится в г. Калуга.<br>
Связаться с менеджером можно по телефону 8ХХХХХХХХХ. Запрос можно отправить по форме ниже.</p><br> -->

<div class="flex-column-center flex-column-xs">
      <form  action="/contacts" method="post" name="client" onreset="resetForm()" class="border" class="flex-column-center">
          <p class="form">Имя</p><p class="errors"></p>
          <input name="client_name"  type="text" placeholder="Введите имя">

          <p class='form'>Фамилия</p><p class="errors"></p>
          <input name="surname" type="text" placeholder="Введите фамилию">

          <p class='form'>Телефон</p><p class="errors"></p>
          <input name="phone" type="text" placeholder="8ХХХХХХХХХ">

          <p class='form'>e-mail</p><p class="errors"></p>
          <input  name="e_mail" type="email" placeholder="Введите e-mail">

          <p class='form'>Запрос</p><p class="errors"></p>
          <input id ='req' name="request" type="text" placeholder="Введите запрос">

          <div class="flex-row">
              <input type="submit" value="Отправить" class="button">
              <input type="reset" value="Очистить" class="button">
          </div>
      </form>
      <p id = 'ans'></p>

</div>

<script src="/static/js/feedback.js"></script>
