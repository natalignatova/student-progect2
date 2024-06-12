<?php

namespace Ig\Lg\Models;

use Ig\Lg\Core\DBConnection;


class AccModel
{   const SUCCESSUSER = "Авторизация пользователя прошла успешно";
    const ERRORUSER = "Ошибка авторизации";
    const SUCCESS = "Данные о поездке добавлены";
    const ERROR = "Данные о поездке не добавлены. Заполните соответствующие поля формы";
    private $db;
    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function authorisation(array $formData)
    {
        $login = $formData['login'];
        $pwd = $formData['pwd'];
        $user = $this->isUser($login);
        if(!$user) {
          return self::ERROR;
        }
        if(!password_verify($pwd, $user['user_pwd'])) {
            return self::ERROR;
        }
        return self::SUCCESSUSER;
    }

    public function isUser(string $login){
        $sql = 'SELECT * FROM users WHERE user_login = :login';
        $user = $this->db->execute($sql,['login'=>$login], false);
        return $user;
    }

    public function getTrips()
    {
      $sql = 'SELECT user_trip.idUserTrip, user_trip.idUser, user_trip.city, user_trip.idProject,user_trip.ticket_date,
      user_trip.ticket, users.user_name, users.user_surname, projects.proj_name, projects.comp_name, projects.proj_city
      FROM user_trip
      LEFT JOIN users ON user_trip.idUser = users.idUser
      LEFT JOIN projects ON user_trip.idProject = projects.idProject
      ORDER BY user_trip.ticket_date DESC';
      return $this->db->queryAll($sql);
    }

    public function addTicket($login, $city, $ticket_date, $files)
    {
        $file_name = $files['ticket']['name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if (!$ext){

        }
        $name = $login . "-" . $city . "-" . $ticket_date;
        $full_name = $name . '.' . $ext;
        $tmp_name = $files['ticket']['tmp_name'];
        $login_dir = 'static/img/' . $login;
        if (!is_dir($login_dir)) {
          mkdir($login_dir);
          move_uploaded_file($tmp_name, $login_dir .'/'. $full_name);
        } else {
          move_uploaded_file($tmp_name, $login_dir .'/'. $full_name);
        }
        return $full_name;
    }

    public function addUserTrip(array $addtrip, $files)
    {
      $login = $_SESSION['login'];
      $user = $this->isUser($login);
      $id = $user['idUser'];
      $city = $addtrip['city'];
      $idProject = $addtrip['idProject'];
      $ticket_date = $addtrip['ticket_date'];
      $ticket = $this->addTicket($login, $city, $ticket_date, $files);


      $trip_sql = "INSERT INTO user_trip (idUser, idProject, city, ticket_date, ticket)
      VALUES (:idUser, :idProject, :city, :ticket_date, :ticket)";

      try{
          // начало транзакции
          $this->db->getConnection()->beginTransaction();
          $trip_params = [
              'idUser' => $id,
              'idProject' => $idProject,
              'city' => $city,
              'ticket_date' => $ticket_date,
              'ticket' => $ticket
          ];
          $this->db->executeSql($trip_sql, $trip_params);

          // подтверждение транзакции
          $this->db->getConnection()->commit();
          return self::SUCCESS;
      } catch (Exception $e) { // Обработка ошибки
//           // откат транзакции
          $this->db->getConnection()->rollBack();
          return self::ERROR;
      }
    }


public function addUserTicket(array $addticket, $files)
{
      $login = $_SESSION['login'];

      $city = $addticket['city'];
      $idUserTrip = $addticket['idUserTrip'];
      $ticket_date = $addticket['ticket_date'];
      $ticket = $this->addTicket($login, $city, $ticket_date, $files);

      $ticket_sql = "UPDATE user_trip SET ticket = :ticket WHERE idUserTrip = :idUserTrip";


  try{
      // начало транзакции
      $this->db->getConnection()->beginTransaction();
      $ticket_params = [
          'ticket' => $ticket,
          'idUserTrip' => $idUserTrip
      ];
      $this->db->executeSql($ticket_sql, $ticket_params);

      // подтверждение транзакции
      $this->db->getConnection()->commit();
      return self::SUCCESS;
  } catch (Exception $e) { // Обработка ошибки
//           // откат транзакции
      $this->db->getConnection()->rollBack();
      return self::ERROR;
  }
}
}
