<?php
namespace Ig\Lg\Controllers;

use Ig\Lg\Core\Controller;
use Ig\Lg\Core\DBConnection;
use Ig\Lg\Models\ServiceModel;

class ServiceController extends Controller
{
    private $service_model;
    // private $db_connection;

    public function __construct()
    {
        $this->service_model = new ServiceModel();
    }

    public function indexAction(){
        $services = $this->service_model->getServices();
        $content = 'services/services.php';
        $data = [
            'page_title'=>'Услуги',
            'services' => $services
        ];
        return $this->generateResponse($content, $data);
    }
  }
