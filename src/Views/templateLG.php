<!DOCTYPE html>

<html lang="ru" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title><? echo $page_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/static/css/lg-style.css">
        <link rel="stylesheet" href="/static/css/menu-lg-style.css">
    </head>
    <body>
	     <div class="flex-row flex-column-xs relative">
		      <div class="flex-1 logo container">
              <a href="/"><img src="/static/img/logo-lg.svg"></a>
          </div>
		      <div class="flex-8">
			        <header>
                  <nav class="dws-menu">
                      <input type="checkbox" name="toggle" id="menu" class="toggleMenu">
                      <label for="menu" class="toggleMenu"><i class="fa "></i>Меню</label>
                      <ul>
                          <? if(isset($_SESSION['login'])): ?>
                              <li><a href="/services"><i class="fa"></i>Услуги</a></li>
                              <li><a href="/projects"><i class="fa"></i>Проекты</a></li>
                              <li><a href="/account"><i class="fa"></i>Аккаунт</a></li>
                              <li><a href="/logout"><i class="fa"></i>Выход</a></li>
                          <? else: ?>
                              <li><a href="/services"><i class="fa"></i>Услуги</a></li>
                              <li><a href="/projects"><i class="fa"></i>Проекты</a></li>
                              <li><a href="/contacts"><i class="fa"></i>Контакты</a></li>
                              <li><a href="/login"><i class="fa"></i>Вход</a></li>
                          <? endif; ?>

                     </ul>
                  </nav>
			        </header>
                  <? include_once $content; ?>
          </div>
       </div>
    </body>
</html>
