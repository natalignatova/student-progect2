<div class="flex-column-center flex-column-xs">
      <form  name="login" onreset="resetForm()" class="border" class="flex-column-center">
            <p class="form">Логин</p><p class="errors"></p>
            <input name="login"  type="text" placeholder="Логин">

            <p class='form'>Пароль</p><p class="errors"></p>
            <input name="pwd" type="password" placeholder="Пароль">
            <div class="flex-row">
                <input type="submit" value="Вход" class="button">
                <input type="reset" value="Отмена" class="button">
            </div>
      </form>

      <p id ='ans'></p>
</div>


<script src="/static/js/enter.js"></script>
