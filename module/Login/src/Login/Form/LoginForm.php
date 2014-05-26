<?php
/**
 * Created by PhpStorm.
 * User: toshmatovus
 * Date: 5/26/14
 * Time: 6:16 PM
 */

namespace Login\Form;

use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('login');

        $this->add(array(
            'name' => 'userid',
            'type' => 'Hidden',
            'class' => 'hidden',
        ));


        $this->add(array(
            'name' => 'email',
            'required' => true,
            'type' => 'Email',
            'options' => array(
                'label' => 'Email Address',
            ),
            'attributes' => array(
                'required' => 'required',
                'id' => 'email',
                'placeholder' => 'Email Address',
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'required' => true,
            'type' => 'Password',
            'options' => array(
                'label' => 'Password',
            ),
            'attributes' => array(
                'required' => 'required',
                'id' => 'password',
                'placeholder' => '',
                'required' => 'required'
            ),
        ));


        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'class'=> 'button',
                'id' => 'submitbutton',
            ),
        ));
    }
}