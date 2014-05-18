<?php
namespace Newsletter\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Newsletter\Model\Newsletter;          // <-- Add this import
use Newsletter\Form\NewsletterForm;       // <-- Add this import
use Zend\Form\Element;

class NewsletterController extends AbstractActionController
{
    public function indexAction()
    {
        $form = new NewsletterForm();
        $this->layout()->setVariable('activeMenuTab', 'newsletter');
        $this->layout()->setTemplate('layout\ajax');
        return new ViewModel(array('form' => $form));
    }

    // Add content to this method:
    public function addAction()
    {
        $data = $this->getRequest()->getPost();
        $this->layout()->setTemplate('layout\ajax');
        $model = new Newsletter();
        $is_email_valid = preg_match('#^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{1,1})+$#',$data['email']);
        if ($is_email_valid){
            $email = strip_tags($data['email']);
            $email = trim($email);
          if ($data['remove'] === 'true'){
              print_r($model->unsubscribe($email));
              return false;
          }else{
              print_r($model->subscribe($email));
              return false;
          }
        }else{
            echo "Your email is not valid";
            return false;
        }
    }



}