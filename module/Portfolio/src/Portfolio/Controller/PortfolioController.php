<?php
namespace Portfolio\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Newsletter\Form\NewsletterForm;
class PortfolioController extends AbstractActionController
{

    protected $newsletterForm;
    public function __construct(){
        $this->newsletterForm = new NewsletterForm();
    }
    public function indexAction()
    {
        $list = array('Resume');
        $this->layout()->setVariable('form',$this->newsletterForm);
        $this->layout()->setVariable('activeMenuTab', 'portfolio');
        return new ViewModel(array('list' => $list));
    }

    public function sentAction()
    {
        return 'sent';
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }

}