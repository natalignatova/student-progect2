<?php
namespace Ig\Lg\Models;

use Ig\Lg\Core\DBConnection;

class ServiceModel
{
    private $db;
    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function getServices()
    {
      $sql = "SELECT * FROM services";
      return $this->db->queryAll($sql);
    }

  }
