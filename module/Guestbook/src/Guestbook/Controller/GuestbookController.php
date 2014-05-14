<?php

namespace Guestbook\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class GuestbookController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }


}

