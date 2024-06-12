<?php
namespace Ig\Lg\Controllers;

use Ig\Lg\Core\Controller;
use Ig\Lg\Core\DBConnection;
use Ig\Lg\Models\IndexModel;
use Ig\Lg\Models\ServiceModel;
use Ig\Lg\Models\ProjectModel;

class IndexController extends Controller
{
  private $index_model;
  private $service_model;
  private $project_model;

  public function __construct()
  {
      $this->index_model = new IndexModel();
      $this->service_model = new ServiceModel();
      $this->project_model = new ProjectModel();

  }

  public function indexAction()
  {
      $news = $this->index_model->getNews();
      $services = $this->service_model->getServices();
      $projects = $this->project_model->getProjects();
      $content = 'main/main.php';
      $data = [
          'page_title'=>'Главная',
          'news' => $news,
          'services' => $services,
          'projects' => $projects

      ];
      return $this->generateResponse($content, $data);
  }
}
