<?php
namespace Ig\Lg\Controllers;

use Ig\Lg\Core\Controller;
use Ig\Lg\Core\DBConnection;
use Ig\Lg\Models\AdminModel;
use Ig\Lg\Models\ProjectModel;
use Ig\Lg\Models\ServiceModel;
use Ig\Lg\Models\IndexModel;
use Ig\Lg\Core\Request;

class AdminController extends Controller
{
    private $admin_model;
    private $project_model;
    private $service_model;
    private $index_model;


    public function __construct()
    {
        $this->admin_model = new AdminModel();
        $this->project_model = new ProjectModel();
        $this->service_model = new ServiceModel();
        $this->index_model = new IndexModel();

    }

    public function login(Request $request) {
          $formData = $request->post();
          $result = $this->admin_model->authorisation($formData);
          if ($result === AdminModel::SUCCESSADMIN) {
              $_SESSION['login'] = $formData['login'];
          }
          return $this->ajaxResponse($result);

      }

    public function indexAction() {
      if (isset($_SESSION['login'])) {
          if ($this->admin_model->isAdmin($_SESSION['login'])) {
              header('Location: /admin/projects');
          }
      }
      $content = 'admin/admin.php';
      $data = [
          'page_title'=>'Авторизация'
      ];
      $template = 'templateZero.php';
      return $this->generateResponse($content, $data, $template);
    }


    public function indexRequest(){
        if (!isset($_SESSION['login'])) {
          header('Location: /');
        }
        if (!$this->admin_model->isAdmin($_SESSION['login'])) {
            header('Location: /');
        }
        $clients = $this->admin_model->getRequests();
        $admin = $this->admin_model->isAdmin($_SESSION['login']);
        $content = 'admin/requests.php';
        $data = [
            'page_title'=>'Запросы',
            'admin' => $admin,
            'clients' => $clients
        ];
        $template = 'templateAdmin.php';
        return $this->generateResponse($content, $data, $template);
    }

    public function indexProject(){
        if (!isset($_SESSION['login'])) {
            header('Location: /');
        }
        if (!$this->admin_model->isAdmin($_SESSION['login'])) {
          header('Location: /');
        }
        $projects = $this->project_model->getProjectsAdmin();
        $admin = $this->admin_model->isAdmin($_SESSION['login']);
        $content = 'admin/projects.php';
        $data = [
            'page_title'=>'Проекты',
            'admin' => $admin,
            'projects' => $projects
        ];
        $template = 'templateAdmin.php';
        return $this->generateResponse($content, $data, $template);
    }
    public function addProject(Request $request){
        $formData = $request->post();
        $files = $request->files();
        $result = $this->admin_model->addProject($formData, $files);
        return $this->ajaxResponse($result);
    }

    public function deleteProjects(Request $request){
      $formData = $request->post();
      $string_ids = $formData['ids']; // 2,4,5
      $result = $this->admin_model->deleteProjects($string_ids);
      return $this->ajaxResponse($result);
  }
  public function changeProjects(Request $request){
    $formData = $request->post();
    $string_change = $formData['change']; // 2,4,5
    $files = $request->files();
    $result = $this->admin_model->changeProjects($string_change, $files);
    return $this->ajaxResponse($result);
}

    public function indexUser(){
        if (!isset($_SESSION['login'])) {
            header('Location: /');
        }
        if (!$this->admin_model->isAdmin($_SESSION['login'])) {
            header('Location: /');
        }
        $users = $this->admin_model->getUsers();
        $trips = $this->admin_model->getTrips();
        $admin = $this->admin_model->isAdmin($_SESSION['login']);
        $content = 'admin/users.php';
        $data = [
            'page_title'=>'Сотрудники',
            'admin' => $admin,
            'users' => $users,
            'trips' => $trips
        ];
        $template = 'templateAdmin.php';
        return $this->generateResponse($content, $data, $template);
      }

      public function addUser(Request $request){
          $formData = $request->post();
          $result = $this->admin_model->addUser($formData);
          return $this->ajaxResponse($result);
      }

      public function changeUser(Request $request){
          $formData = $request->post();
          $string_change = $formData['change']; // 2,4,5
          $result = $this->admin_model->changeUser($string_change);
          return $this->ajaxResponse($result);
      }

      public function deleteUser(Request $request){
        $formData = $request->post();
        $string_ids = $formData['ids'];
        $result = $this->admin_model->deleteUser($string_ids);
        return $this->ajaxResponse($result);
    }

  //   public function showUser(Request $request) {
  //     // public function showUser() {
  //
  //       if (!isset($_SESSION['login'])) {
  //           header('Location: /');
  //       }
  //       if (!$this->admin_model->isAdmin($_SESSION['login'])) {
  //           header('Location: /');
  //       }
  //       $id = $request->params()['id'];
  //       // var_dump($id);
  //   //  $content = 'admin/users.php';
  //     $users = $this->admin_model->getUsers();
  //     // $id = $users['idUser'];
  //     $user = $this->admin_model->getUserById($id);
  //     $data = [
  //         'page_title' => 'Сотрудники',
  //         'users'=>$users,
  //         'user'=>$user
  //     ];
  //     $template = 'templateAdmin.php';
  //     // var_dump($content);
  //     return $this->generateResponse($content, $data, $template);
  // }

    public function indexService(){
      if (!isset($_SESSION['login'])) {
          header('Location: /');
      }
      if (!$this->admin_model->isAdmin($_SESSION['login'])) {
          header('Location: /');
      }
        $services = $this->service_model->getServices();
        $admin = $this->admin_model->isAdmin($_SESSION['login']);
        $content = 'admin/services.php';
        $data = [
            'page_title'=>'Услуги',
            'admin' => $admin,
            'services' => $services
        ];
        $template = 'templateAdmin.php';
        return $this->generateResponse($content, $data, $template);
    }

    public function indexNews(){
      if (!isset($_SESSION['login'])) {
          header('Location: /');
      }
      if (!$this->admin_model->isAdmin($_SESSION['login'])) {
          header('Location: /');
      }
        $news = $this->index_model->getNews();
        $admin = $this->admin_model->isAdmin($_SESSION['login']);
        $content = 'admin/news.php';
        $data = [
            'page_title'=>'Новости',
            'admin' => $admin,
            'news' => $news
        ];
        $template = 'templateAdmin.php';
        return $this->generateResponse($content, $data, $template);
    }

    public function addNews(Request $request){
        $formData = $request->post();
        $result = $this->admin_model->addNews($formData);
        return $this->ajaxResponse($result);
    }

      public function deleteNews(Request $request){
        $formData = $request->post();
        $sting_ids = $formData['ids']; // 2,4,5

        $result = $this->admin_model->deleteNews($sting_ids);
        return $this->ajaxResponse($result);
    }

    public function changeNews(Request $request){
      $formData = $request->post();
      $string_change = $formData['change']; // 2,4,5

      $result = $this->admin_model->changeNews($string_change);
      return $this->ajaxResponse($result);
  }

  }
