<?php
namespace Ig\Lg\Models;

use Ig\Lg\Core\DBConnection;

class ContactModel
{   const SUCCESS = "Запрос отправлен";
    const ERROR = "Ошибка отправки запроса";
    private $db;
    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function addRequest(array $client_data){
        $cname = $client_data['client_name'];
        $csurname = $client_data['surname'];
        $cphone = $client_data['phone'];
        $cmail = $client_data['e_mail'];
        $crequest = $client_data['request'];
        $cdate = new \DateTime(); //date("Y-m-d H:i:s");
        $cdate = $cdate->format("Y-m-d H:i:s");

        $client_sql = "INSERT INTO clients (client_name, surname, phone, e_mail, request, client_date)
        VALUES (:cname, :csurname, :cphone, :cmail, :crequest, :cdate)";

        try{
            // начало транзакции
            $this->db->getConnection()->beginTransaction();
            $client_params = [
                'cname' => $cname,
                'csurname' => $csurname,
                'cphone' => $cphone,
                'cmail' => $cmail,
                'crequest' => $crequest,
                'cdate' => $cdate
            ];
            $this->db->executeSql($client_sql, $client_params);

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
