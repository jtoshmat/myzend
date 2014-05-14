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

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
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
