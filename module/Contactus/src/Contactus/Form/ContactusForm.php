<?php
namespace Contactus\Form;

use Zend\Form\Form;

class ContactusForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('contactus');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
            'class' => 'hidden',
        ));
        $this->add(array(
            'name' => 'country',
            'type' => 'Text',
            'options' => array(
                'label' => 'Country',
            ),
            'attributes' => array(
                'value' => '',
                'required' => true,
                'class'=> 'text',
                'id' => 'country',
            ),
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(10, 20))
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