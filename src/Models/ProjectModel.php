<?php
namespace Ig\Lg\Models;

use Ig\Lg\Core\DBConnection;

class ProjectModel
{
    private $db;
    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function getProjects()
    {
      $sql = "SELECT idProject, proj_name, proj_city, proj_desc,
       DATE_FORMAT(proj_date_begin,'%d.%m.%Y') as proj_date_begin,
       DATE_FORMAT(proj_date_end,'%d.%m.%Y') as proj_date_end, proj_on_site, comp_name, comp_logo, proj_pic
       FROM projects WHERE proj_on_site = 'да'";
      return $this->db->queryAll($sql);
    }
    public function getProjectsAdmin()
    {
      $sql = "SELECT idProject, proj_name, proj_city, proj_desc,
       DATE_FORMAT(proj_date_begin,'%d.%m.%Y') as proj_date_begin,
       DATE_FORMAT(proj_date_end,'%d.%m.%Y') as proj_date_end, proj_on_site, proj_contract, comp_name, comp_logo, proj_pic
       FROM projects";
      return $this->db->queryAll($sql);
    }

  }
