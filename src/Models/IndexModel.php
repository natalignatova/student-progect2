<?php
namespace Ig\Lg\Models;

use Ig\Lg\Core\DBConnection;

class IndexModel
{
    private $db;
    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function getNews()
    {
      // $sql = "SELECT idNews, news_name, news_desc, DATE_FORMAT(news_date,'%d.%m.%Y') as news_date  FROM news ORDER BY news_date DESC";
      $sql = "SELECT idNews, news_name, news_desc, news_date  FROM news ORDER BY news_date DESC";
      return $this->db->queryAll($sql);
    }

  }
