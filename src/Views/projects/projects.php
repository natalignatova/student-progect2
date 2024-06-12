<?php foreach ($data['projects'] as $project) :?>
    <div class="lg-div border flex-row flex-column-xs">
        <div class="flex-1 lg-img border-lg display-none-xs">
            <img src="/static/img/<? echo $project['comp_name'];?>/<? echo $project['proj_pic'];?>">
        </div>
        <div class="flex-2 flex-column-r overflow-auto">
            <h3><? echo $project['proj_name'];?></h3></br>
            <p>
                <span><? echo $project['comp_name']; ?></span> | <span><? echo $project['proj_city']; ?></span>
            </p></br>
            <p><? echo $project['proj_desc'];?></p>
        </div>
    </div>
<?php endforeach; ?>
