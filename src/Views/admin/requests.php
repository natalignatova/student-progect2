 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 margin">
   <div class="card">
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Дата</th>
              <th scope="col">Имя</th>
              <th scope="col">Фамилия</th>
              <th scope="col">Номер телефона</th>
              <th scope="col">e-mail</th>
              <th scope="col">Запрос</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($clients as $client) :?>
            <tr>
              <td><? echo $client['client_date'];?></td>
              <td><? echo $client['client_name'];?></td>
              <td><? echo $client['surname'];?></td>
              <td><? echo $client['phone'];?></td>
              <td><? echo $client['e_mail'];?></td>
              <td><? echo $client['request'];?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
