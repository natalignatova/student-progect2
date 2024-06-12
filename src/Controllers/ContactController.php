<?php
namespace Ig\Lg\Controllers;

use Ig\Lg\Core\Controller;
use Ig\Lg\Core\DBConnection;
use Ig\Lg\Models\ContactModel;
use Ig\Lg\Core\Request;


class ContactController extends Controller
{

  private $contact_model;

  public function __construct()
  {
      $this->contact_model = new ContactModel();
  }

    public function indexAction(){
        $content = 'contacts/contacts.php';
        $data = [
            'page_title'=>'Контакты'

        ];
        return $this->generateResponse($content, $data);
    }

    public function addRequest(Request $request){
        $formData = $request->post();
        $result = $this->contact_model->addRequest($formData);
        return $this->ajaxResponse($result);
    }



  }
