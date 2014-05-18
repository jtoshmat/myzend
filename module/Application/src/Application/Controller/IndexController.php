<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Contactus\Form\ContactusForm;
use Newsletter\Form\NewsletterForm;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $this->getRequest();
        $email = $this->params()->fromRoute('email');
        echo $email;
        $form = new NewsletterForm();
        $this->layout()->setVariable('form',$form);

        $is_email_valid = preg_match('#^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{1,1})+$#','jon@toshmatov.us');
          echo $is_email_valid;
            return false;
        return new ViewModel();
    }

    public function aboutusAction(){
        $this->layout()->setVariable('activeMenuTab', 'aboutus');
        return new ViewModel();
    }

    public function portfolioAction(){
        $this->layout()->setVariable('activeMenuTab', 'portfolio');
        return new ViewModel();
    }

    public function subscribeAction(){
        $this->layout()->setTemplate('layout/ajax');
        return array('email'=>'success');
    }
}
