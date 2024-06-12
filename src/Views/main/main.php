<div class="flex-row flex-column-xs">
    <div class="flex-4 flex-column display-none-xs">
        <div class="main_height ">
            <section id="slider" class="servise border">
                <ul>
                  <?php foreach ($data['services'] as $service) :?>
                    <li>
                        <img src="/static/img/<? echo $service['serv_pic'];?>">
                        <div class="servise_info top-left">
                            <h1><? echo $service['serv_name'];?></h1>
                            <p><? echo $service['serv_desc'];?></p>
                        </div>
                    </li>
                    <?php endforeach; ?>
            </section>
        <div class="main_idea">
            <p>Опыт. Безопасность. Качество.</p>
        </div>

        <div class="flex-row pf-height">

            <div class="flex-3 partners top-left flex-column-r">
                <h3>Наши заказчики и партнеры</h3>
                <div id='slider2'>
                    <?php foreach ($data['projects'] as $project) :?>
                    <li>
                        <img src="/static/img/<? echo $project['comp_logo']; ?>">
                    </li>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="flex-2 client top-left flex-column-r">
                <h3>ООО "ОО", входящее в группу "АА", выражает благодарность компании
                  "ЛЕММИНГ ГРУП" за плодотворное сотрудничество </h3>
                <h3> Заместитель директора по строительству ООО "ОО" Иванов И.И. </h3>
            </div>
        </div>

    </div>
</div>
<div class="flex-2 flex-column main_height display-none-md">
        <div class="business_card_qr">
            <div class="front"><p>телефон<br>для<br>связи</p></div>
            <div class="back"></div>
        </div>
        <div class="news-box flex-column">
          <h3>Новости компании</h3>
                <?php foreach ($data['news'] as $news_1) :?>
                <div class="container">
                    <p><? echo $news_1['news_name'];?></p>
                    <p><? echo $news_1['news_desc'];?></p>
                    <p>
                    <? echo date("d.m.Y",strtotime($news_1['news_date']))?>
                    </p>
                </div>
                <?php endforeach; ?>
        </div>
    </div>
</div>
</div>
</div>
</div>
<script src="/static/js/slider.js"></script>
