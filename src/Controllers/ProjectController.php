<?php
namespace Ig\Lg\Controllers;

use Ig\Lg\Core\Controller;
use Ig\Lg\Core\DBConnection;
use Ig\Lg\Models\ProjectModel;

class ProjectController extends Controller
{
    private $project_model;

    public function __construct()
    {
        $this->project_model = new ProjectModel();
    }

    public function indexAction(){
        $projects = $this->project_model->getProjects();
        $content = 'projects/projects.php';
        $data = [
            'page_title'=>'Проекты',
            'projects' => $projects
        ];
        return $this->generateResponse($content, $data);
    }
  }
