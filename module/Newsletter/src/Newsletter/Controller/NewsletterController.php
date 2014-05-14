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
        $qs = $this->getRequest()->getParams();
        $form = new NewsletterForm();
         return new ViewModel(array('form' => $form,'qs' => $qs));
    }



}