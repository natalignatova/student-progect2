
 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
   <div class="flex-row text-right margin">
     <a href="#stringAddNews">
        <input id='showAddForm' class="btn btn-secondary" type="button" onclick="showForm()" value="Добавить новость">
     </a>


     <input id='showDeleteForm' class="btn btn-secondary" type="button" onclick="deleteForm()" value="Удалить новость">
     <input id='DeleteFormNews' type="button" value="Удалить">


     <input id='showChangeForm' class="btn btn-secondary" type="button" onclick="changeForm()" value="Изменить новость">
     <input id='ChangeFormNews' type="button" value="Изменить">

     <input id='resetForm' onclick="closeForm()" type="reset"  value="Отменить">
     <p id='ans'> </p>

   </div>

  <div class="card">

     <div class="card-body">
       <table class="table">
         <thead>
           <tr>
             <th>Новость</th>
             <th>Описание</th>
             <th id='date_change'></th>
             <th id='date_now'>Дата</th>
             <!-- <th class='invis'>Удалить</th> -->
             <th id='delete_change'>Удалить</th>
          </tr>
         </thead>
         <tbody>
           <?php foreach ($news as $news_1) :?>
             <!-- <form  action="/admin/deleteNews" method="post" name='deletenews'> -->
           <tr>

               <th><textarea cols="25" rows="3" name="news_name"><? echo $news_1['news_name'];?></textarea></th>
               <th><textarea  cols="60" rows="4" name="news_desc"><? echo $news_1['news_desc'];?></textarea></th>
               <th><input  type="date" id="news_date" name="news_date"></th>

               <!-- <th><? echo $news_1['news_date'];?></th> -->
               <th><? echo date("d.m.Y",strtotime($news_1['news_date']))?></th>


               <th ><input type="checkbox" value="<? echo $news_1['idNews'];?>" name="idNews[]" onclick='checkedChange()'></th>
          </tr>
          <!-- </form> -->
          <?php endforeach; ?>
          <tr id='stringAddNews' class='invis'>
            <form action='/admin/addNews' method="post" name='addnews'>
              <th><textarea cols="25" rows="3" name="news_name">Новость</textarea></th>
              <th><textarea cols="60" rows="4" name="news_desc">Описание новости</textarea></th>
              <th><input  type="date" name="news_date"></th>
         </tr>
         </tbody>
       </table>

     </div>
   </div>
 </div>
 <div class="flex-row text-right">
   <input id='sendFormNews'  type="submit" value="Добавить">
   <input id='resetForm2' onclick="closeForm()" type="reset"  value="Отменить">

 </div>
</form>

 <script src="/static/js/news.js"></script>
