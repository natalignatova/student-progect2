<?php foreach ($data['services'] as $service) :?>
    <div class="lg-div border flex-row flex-column-xs">
        <div class="flex-1 lg-img border-lg display-none-xs">
            <img src="/static/img/<? echo $service['serv_pic'];?>">
        </div>
        <div class="flex-2 flex-column-r">
            <h3><? echo $service['serv_name'];?></h3></br>
            <p><? echo $service['serv_desc'];?></p>
        </div>
    </div>
<?php endforeach; ?>
