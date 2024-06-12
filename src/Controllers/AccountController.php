<?php

namespace Ig\Lg\Controllers;

use Ig\Lg\Core\Controller;
use Ig\Lg\Core\Request;
use Ig\Lg\Models\AccModel;
use Ig\Lg\Models\ProjectModel;

class AccountController extends Controller
{
    private $account_model;
    private $project_model;

    public function __construct()
    {
        $this->account_model = new AccModel();
        $this->project_model = new ProjectModel();
    }

      public function indexAction() {
        $content = 'account/login.php';
        $data = [
            'page_title'=>'Авторизация'
        ];
        return $this->generateResponse($content, $data);
    }

    public function getUserPage() {
        if (!isset($_SESSION['login'])) {
          header('Location: /');
        }

            $content = 'account/account.php';
            $data = [
                'page_title'=>'Личный кабинет',
                'projects' => $this->project_model->getProjectsAdmin(),
                'user' => $this->account_model->isUser($_SESSION['login']),
                'user_trips' => $this->account_model->getTrips()
            ];

            return $this->generateResponse($content, $data);
      }


        public function login(Request $request) {
            $formData = $request->post();
            $result = $this->account_model->authorisation($formData);
            if ($result === AccModel::SUCCESSUSER) {
                $_SESSION['login'] = $formData['login'];
            }
            return $this->ajaxResponse($result);

        }

        public function addTrip(Request $request){
            $formData = $request->post();
            $files = $request->files();
            $result = $this->account_model->addUserTrip($formData, $files);
            return $this->ajaxResponse($result);
        }

        public function addUserTicket(Request $request){
            $formData = $request->post();
            $files = $request->files();
            $result = $this->account_model->addUserTicket($formData, $files);
            return $this->ajaxResponse($result);
        }

        public function logout() {
            unset($_SESSION['login']);
            $_SESSION = [];
            session_destroy();
            header('Location: /');
        }

  }
