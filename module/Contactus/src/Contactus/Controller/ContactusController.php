<?php
namespace Contactus\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Contactus\Model\Contactus;          // <-- Add this import
use Contactus\Form\ContactusForm;       // <-- Add this import
use Zend\Form\Element;
use Newsletter\Form\NewsletterForm;
class ContactusController extends AbstractActionController
{

    protected $newsletterForm;
    public function __construct(){
        $this->newsletterForm = new NewsletterForm();
    }
    public function indexAction()
    {
        $form = new ContactusForm();
        $list = array('google map');
        $qs = $this->getRequest()->getQuery();
        $vals = $this->getRequest()->getPost();
        $this->layout()->setVariable('activeMenuTab', 'contactus');
        $this->layout()->setVariable('form',$this->newsletterForm);
        return new ViewModel(array('form' => $form,'qs' => $qs,'vals' => $vals));
    }

    // Add content to this method:
    public function addAction()
    {
        $qs = $this->getRequest()->getParams();
        $form = new ContactusForm();
        $this->layout()->setVariable('form',$this->newsletterForm);
         return new ViewModel(array('form' => $form,'qs' => $qs));
    }



}