<?php
namespace Portfolio\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PortfolioController extends AbstractActionController
{
    public function indexAction()
    {
        $list = array('Resume');
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