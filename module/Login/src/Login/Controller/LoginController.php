<?php
/**
 * Created by PhpStorm.
 * User: toshmatovus
 * Date: 5/25/14
 * Time: 10:55 AM
 */

namespace Login\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Newsletter\Form\NewsletterForm;
use Login\Form\LoginForm;
use Application\Model\MYSQLDB;

class LoginController extends AbstractActionController
{
    protected $loginForm;
    public function __construct(){
        $this->newsletterForm = new NewsletterForm();
        $this->loginForm = new LoginForm();
    }
    public function indexAction()
    {
        $list = array('Login');
        $this->layout()->setVariable('form',$this->newsletterForm);
        $this->layout()->setVariable('activeMenuTab', 'login');
        $request = $this->getRequest();
        if ($request->isPost()){
            $this->layout()->setTemplate('layout/ajax');
            echo "<pre>";
            var_dump($this->loginAction());
            return false;
        }
        return new ViewModel(array('list' => $list,'loginForm' => $this->loginForm));
    }

    public function loginAction()
    {
       $db = new MYSQLDB();
        $results = $db->setConn()->query("SELECT * FROM users");
        return $results->execute()->next();

    }


}