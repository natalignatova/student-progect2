<?php
namespace Ig\Lg\Models;

use Ig\Lg\Core\DBConnection;

class AdminModel
{
    const SUCCESS = "Добавлено";
    const ERROR = "Не добавлено";
    const SUCCESSDEL = "Удалено";
    const ERRORDEL = "Не удалено";
    const SUCCESSADMIN = "Авторизация админа прошла успешно";
    const ERRORADMIN = "Ошибка авторизации";
    const SUCCESSCHANGE = "Изменено";
    const ERRORCHANGE = "Не изменено";
    private $db;

    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function authorisation(array $formData)
    {
        $login = $formData['login'];
        $pwd = $formData['pwd'];
        $admin = $this->isAdmin($login);
        if(!$admin) {
            echo "админа нет";
            return self::ERRORADMIN;

        }
        if(!password_verify($pwd, $admin['admin_pwd'])) {
            echo "пароля админа нет";
            return self::ERRORADMIN;
        }
        return self::SUCCESSADMIN;
    }

    public function isAdmin(string $login){
        $sql = 'SELECT * FROM admin WHERE admin_login = :login';
        $admin = $this->db->execute($sql,['login'=>$login], false);
        return $admin;
    }

    public function getRequests()
    {
      $sql = "SELECT client_name, surname, phone, e_mail, request, DATE_FORMAT(client_date,'%d.%m.%Y') as client_date  FROM clients ORDER BY client_date DESC";
      return $this->db->queryAll($sql);
    }

    public function getUsers()
    {
      $sql = "SELECT idUser,user_name, user_second_name, user_surname, DATE_FORMAT(user_birthdate,'%d.%m.%Y') as user_birthdate,
      user_city, user_phone, user_contract, user_postion, user_spec,
      user_spec_level, user_postion, DATE_FORMAT(user_contract_begin,'%d.%m.%Y') as user_contract_begin,
      DATE_FORMAT(user_contract_end,'%d.%m.%Y') as user_contract_end, user_login FROM users";
      return $this->db->queryAll($sql);
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

    public function addUser(array $user_data)
    {
        $user_surname = mb_convert_case($user_data['user_surname1'], MB_CASE_TITLE, "UTF-8");
        $uname = mb_convert_case($user_data['user_name1'], MB_CASE_TITLE, "UTF-8");
        $usname = mb_convert_case($user_data['user_second_name1'], MB_CASE_TITLE, "UTF-8");
        $ubirth = $user_data['user_birthdate1'];
        $ucity = $user_data['user_city1'];
        $uphone = $user_data['user_phone1'];
        $uposition = mb_convert_case($user_data['user_position1'], MB_CASE_TITLE, "UTF-8");
        $uspec = mb_convert_case($user_data['user_spec1'], MB_CASE_TITLE, "UTF-8");
        $uspeclevel = $user_data['user_spec_level1'];
        $ucontract = $user_data['user_contract1'];
        $uconbegin = $user_data['user_contract_begin1'];
        $uconend = $user_data['user_contract_end1'];
        $ulogin = $user_data['user_login1'];
        $upwd = password_hash($user_data['user_pwd1'], PASSWORD_DEFAULT);


        $user_sql = "INSERT INTO users (user_surname, user_name, user_second_name, user_birthdate, user_city, user_phone, user_postion, user_spec,
        user_spec_level, user_contract, user_contract_begin, user_contract_end, user_login, user_pwd)
        VALUES (:user_surname, :user_name, :user_second_name, :user_birthdate, :user_city, :user_phone, :user_position, :user_spec,
        :user_spec_level, :user_contract, :user_contract_begin, :user_contract_end, :user_login, :user_pwd)";

        try
        {
            // начало транзакции
            $this->db->getConnection()->beginTransaction();
            $user_params = [
                'user_surname' => $user_surname,
                'user_name' => $uname,
                'user_second_name' => $usname,
                'user_birthdate' => $ubirth,
                'user_city' => $ucity,
                'user_phone' => $uphone,
                'user_position' => $uposition,
                'user_spec' => $uspec,
                'user_spec_level' => $uspeclevel,
                'user_contract' => $ucontract,
                'user_contract_begin' => $uconbegin,
                'user_contract_end' => $uconend,
                'user_login' => $ulogin,
                'user_pwd' => $upwd
            ];
            $this->db->executeSql($user_sql, $user_params);
            $this->db->getConnection()->commit();
            return self::SUCCESS;
        } catch (Exception $e) {
            $this->db->getConnection()->rollBack();
            return self::ERROR;
        }
    }

    public function changeUser(string $change_user)
    {
        $arr = json_decode($change_user, false, 512, JSON_OBJECT_AS_ARRAY);

        $user_surname = mb_convert_case($arr[0], MB_CASE_TITLE, "UTF-8");
        $uname = mb_convert_case($arr[1], MB_CASE_TITLE, "UTF-8");
        $usname = mb_convert_case($arr[2], MB_CASE_TITLE, "UTF-8");
        $ubirth = $arr[3];
        $ucity = $arr[4];
        $uphone = $arr[5];
        $uposition = mb_convert_case($arr[6], MB_CASE_TITLE, "UTF-8");
        $uspec = mb_convert_case($arr[7], MB_CASE_TITLE, "UTF-8");
        $uspeclevel = $arr[8];
        $ucontract = $arr[9];
        $uconbegin = $arr[10];
        $uconend = $arr[11];
        $ulogin = $arr[12];
        $upwd = password_hash($arr[13], PASSWORD_DEFAULT);
        $uId = $arr[14];


        $user_sql = "UPDATE users SET user_surname = IF(:user_surname = '', user_surname, :user_surname),
        user_name = IF(:user_name = '', user_name, :user_name),
        user_second_name = IF(:user_second_name = '', user_second_name, :user_second_name),
        user_birthdate = IF(:user_birthdate = '', user_birthdate, :user_birthdate),
        user_city = IF(:user_city = '', user_city, :user_city),
        user_phone = IF(:user_phone = '', user_phone, :user_phone),
        user_postion = IF(:user_position = '', user_postion, :user_position),
        user_spec = IF(:user_spec = '', user_spec, :user_spec),
        user_spec_level = IF(:user_spec_level = '', user_spec_level, :user_spec_level),
        user_contract = IF(:user_contract = '', user_contract, :user_contract),
        user_contract_begin = IF(:user_contract_begin = '', user_contract_begin, :user_contract_begin),
        user_contract_end = IF(:user_contract_end = '', user_contract_end, :user_contract_end),
        user_login = IF(:user_login = '', user_login, :user_login),
        user_pwd = IF(:user_pwd = '', user_pwd, :user_pwd)  WHERE idUser = :idUser";

        try
        {
            // начало транзакции
            $this->db->getConnection()->beginTransaction();
            $user_params = [
                'user_surname' => $user_surname,
                'user_name' => $uname,
                'user_second_name' => $usname,
                'user_birthdate' => $ubirth,
                'user_city' => $ucity,
                'user_phone' => $uphone,
                'user_position' => $uposition,
                'user_spec' => $uspec,
                'user_spec_level' => $uspeclevel,
                'user_contract' => $ucontract,
                'user_contract_begin' => $uconbegin,
                'user_contract_end' => $uconend,
                'user_login' => $ulogin,
                'user_pwd' => $upwd,
                'idUser' => $uId
            ];
            $this->db->executeSql($user_sql, $user_params);
            $this->db->getConnection()->commit();
            return self::SUCCESSCHANGE;
        } catch (Exception $e) {
            $this->db->getConnection()->rollBack();
            return self::ERRORCHANGE;
        }
    }

    public function deleteUser(string $user_del_id)
        {
            $del_user_sql = "DELETE FROM users WHERE idUser IN ($user_del_id) ";
            try
            {
                $user_del = [
                    'ids' => $news_del_id
                ];
                $this->db->exec($del_user_sql);
                return self::SUCCESSDEL;
            } catch (Exception $e)
            {
                return self::ERRORDEL;
            }
        }

    public function addNews(array $news_data)
    {
        $nname = $this->getText($news_data['news_name']);
        $ndesc = $this->getText($news_data['news_desc']);
        $ndate = $news_data['news_date'];

        $news_sql = "INSERT INTO news (news_name, news_desc, news_date)
        VALUES (:nname, :ndesc, :ndate)";

        try
        {
            // начало транзакции
            $this->db->getConnection()->beginTransaction();
            $news_params = [
                'nname' => $nname,
                'ndesc' => $ndesc,
                'ndate' => $ndate
            ];
            $this->db->executeSql($news_sql, $news_params);

            // подтверждение транзакции
            $this->db->getConnection()->commit();
            return self::SUCCESS;
        } catch (Exception $e) { // Обработка ошибки
//           // откат транзакции
            $this->db->getConnection()->rollBack();
            return self::ERROR;

        }
    }

private function getText($string)
    {
        $strArr = mb_split(" ", $string);
        $newStrArr = [];
        $upWord = mb_convert_case(mb_strtolower($strArr[0]), MB_CASE_TITLE);
        array_push($newStrArr, $upWord);
        for ($i = 1; $i < count($strArr); $i++)
            {
            array_push($newStrArr, $strArr[$i]);
            }
        $string = implode(" ", $newStrArr);
        if (!preg_match("$\.$", $string))
            {
                $string = $string . ".";
            }
        return $string;
    }

public function deleteNews(string $news_del_id){

        $del_news_sql = "DELETE FROM news WHERE idNews IN ($news_del_id) ";
        try
        {
            // $news_del = [
            //     'ids' => $news_del_id
            // ];
            $this->db->exec($del_news_sql);
            return self::SUCCESSDEL;
        } catch (Exception $e)
        {
            return self::ERRORDEL;
        }
    }

    public function changeNews(string $change)
    {
        $arrs = json_decode($change, false, 512, JSON_OBJECT_AS_ARRAY);
        // var_dump($arrs);
        foreach ($arrs as $arr)
        {
          $count = $this->change1News($arr);
          $n = $n + $count;
        }
        // var_dump($n, count($arrs));
        if ($n === count($arrs)){
            return self::SUCCESSCHANGE;
        } else {
            return self::ERRORCHANGE;
        }

    }

    private function change1News(array $arr)
        {
            $idNews = $arr[0];
            $nname = $arr[1];
            $ndesc = $arr[2];
            $ndate = $arr[3];
            $n = 0;

            $news_sql = "UPDATE news SET news_name = IF(:nname = '', news_name, :nname), news_desc = IF(:ndesc = '', news_desc, :ndesc),
            news_date = IF(:ndate = '', news_date, :ndate) WHERE idNews = :idNews";
	          try
            {
                // начало транзакции
                $this->db->getConnection()->beginTransaction();
                $news_params = [
                    'idNews' => $idNews,
                    'nname' => $nname,
                    'ndesc' => $ndesc,
                    'ndate' => $ndate
                ];
            $this->db->executeSql($news_sql, $news_params);
            // подтверждение транзакции
            $this->db->getConnection()->commit();
            $n = $n + 1;
            return $n;
          } catch (Exception $e)
          {
            $this->db->getConnection()->rollBack();
            return $n;
          }
      }

      public function deleteProjects(string $projects_del_id){
        // var_dump($projects_del_id);
              $del_projects_sql = "DELETE FROM projects WHERE idProject IN ($projects_del_id) ";
              try
              {
                  // $projects_del = [
                  //     'ids' => $projects_del_id
                  // ];
                  $this->db->exec($del_projects_sql);
                  return self::SUCCESSDEL;
              } catch (Exception $e)
              {
                  return self::ERRORDEL;
              }
          }

      public function addProject(array $project, $files)
      {
          $proj_name = $this->getText($project['proj_name']);
          // var_dump($proj_name);
          $proj_city = $project['proj_city'];
          $comp_name = $project['comp_name'];
          $proj_desc = $this->getText($project['proj_desc']);
          $proj_contract = $project['proj_contract'];
          // var_dump($proj_contract);
          $proj_date_begin = $project['proj_date_begin'];
          $proj_date_end = $project['proj_date_end'];
          $proj_pic = $this->addPhotoProject($comp_name, $files);
          // var_dump($proj_pic);
          $proj_on_site = $project['proj_on_site'];


          $proj_sql = "INSERT INTO projects (proj_name, proj_city, comp_name,
          proj_desc, proj_contract, proj_date_begin, proj_date_end,
          proj_pic, proj_on_site) VALUES (:proj_name,:proj_city, :comp_name,
          :proj_desc, :proj_contract, :proj_date_begin, :proj_date_end,
          :proj_pic, :proj_on_site)";

          try
          {
              // начало транзакции
              $this->db->getConnection()->beginTransaction();
              $proj_params = [
                  'proj_name' => $proj_name,
                  'proj_city' => $proj_city,
                  'comp_name' => $comp_name,
                  'proj_desc' => $proj_desc,
                  'proj_contract' => $proj_contract,
                  'proj_date_begin' => $proj_date_begin,
                  'proj_date_end' => $proj_date_end,
                  'proj_pic' => $proj_pic,
                  'proj_on_site' => $proj_on_site
              ];
              $this->db->executeSql($proj_sql, $proj_params);

              // подтверждение транзакции
              $this->db->getConnection()->commit();
              return self::SUCCESS;
          } catch (Exception $e) { // Обработка ошибки
  //           // откат транзакции
              $this->db->getConnection()->rollBack();
              return self::ERROR;

          }
      }

public function addPhotoProject($comp_name, $files){
          $file_name = $files['proj_pic']['name'];
          $ext = pathinfo($file_name, PATHINFO_EXTENSION);
          $cdate = new \DateTime();
          $cdate = $cdate->format("Y-m-d");
          $name = $comp_name . "-" . $cdate;
          $full_name = $name . '.' . $ext;
          $tmp_name = $files['proj_pic']['tmp_name'];
          $proj_dir = 'static/img/' . $comp_name;
          // var_dump($login_dir);
          if (!is_dir($proj_dir)) {
            mkdir($proj_dir);
            move_uploaded_file($tmp_name, $proj_dir .'/'. $full_name);
          } else {
            move_uploaded_file($tmp_name, $proj_dir .'/'. $full_name);
          }
          return $full_name;
      }


    public function changeProjects(string $change, $files)
    {
        $arrs = json_decode($change, false, 512, JSON_OBJECT_AS_ARRAY);
        // var_dump($arrs);
        foreach ($arrs as $arr)
        {
          $count = $this->change1Project($arr, $files);
          $n = $n + $count;
        }
        // var_dump($n, count($arrs));
        if ($n === count($arrs)){
            return self::SUCCESSCHANGE;
        } else {
            return self::ERRORCHANGE;
        }

    }

    private function change1Project(array $arr, $files)
        {
            $idProject = $arr[0];
            $proj_name = $arr[1];
            $proj_city = $arr[2];
            $comp_name = $arr[3];
            $proj_desc = $arr[4];
            $proj_contract = $arr[5];
            $proj_date_begin = $arr[6];
            $proj_date_end = $arr[7];
            $proj_on_site = $arr[8];
            $proj_pic = $this->changePhotoProject($comp_name, $idProject, $files);
            $n = 0;

            $sql = "UPDATE projects SET proj_name = IF(:proj_name = '', proj_name, :proj_name),
            proj_city = IF(:proj_city = '', proj_city, :proj_city),
            comp_name = IF(:comp_name = '', comp_name, :comp_name),
            proj_desc = IF(:proj_desc = '', proj_desc, :proj_desc),
            proj_contract = IF(:proj_contract = '', proj_contract, :proj_contract),
            proj_date_begin = IF(:proj_date_begin = '', proj_date_begin, :proj_date_begin),
            proj_date_end = IF(:proj_date_end = '', proj_date_end, :proj_date_end),
            proj_on_site = :proj_on_site,
            proj_pic = IF(:proj_pic = 'нет', proj_pic, :proj_pic)
            WHERE idProject = :idProject";
	          try
            {
                // начало транзакции
                $this->db->getConnection()->beginTransaction();
                $params = [
                    'proj_name' => $proj_name,
                    'proj_city' => $proj_city,
                    'comp_name' => $comp_name,
                    'proj_desc' => $proj_desc,
                    'proj_contract' => $proj_contract,
                    'proj_date_begin' => $proj_date_begin,
                    'proj_date_end' => $proj_date_end,
                    'proj_on_site' => $proj_on_site,
                    'proj_pic' => $proj_pic,
                    'idProject' => $idProject
                ];
            $this->db->executeSql($sql, $params);
            // подтверждение транзакции
            $this->db->getConnection()->commit();
            $n = $n + 1;
            return $n;
          } catch (Exception $e)
          {
            $this->db->getConnection()->rollBack();
            return $n;
          }
        }

          public function changePhotoProject($comp_name, $idProject, $files){
                    $file_name = $files['proj_pic'. $idProject]['name'];
                    if (!file_exists($file_name)){
                        return 'нет';
                    }
                    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                    $cdate = new \DateTime();
                    $cdate = $cdate->format("Y-m-d");
                    $name = $comp_name . "-" . $cdate  ;
                    $full_name = $name . '.' . $ext;
                    $tmp_name = $files['proj_pic'. $idProject]['tmp_name'];
                    $proj_dir = 'static/img/' . $comp_name;
                    // var_dump($login_dir);
                    if (!is_dir($proj_dir)) {
                      mkdir($proj_dir);
                      move_uploaded_file($tmp_name, $proj_dir .'/'. $full_name);
                    } else {
                      move_uploaded_file($tmp_name, $proj_dir .'/'. $full_name);
                    }
                    return $full_name;
                }
              }
