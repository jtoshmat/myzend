<?php
namespace Newsletter\Form;

use Zend\Form\Form;

class NewsletterForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('newsletter');

        $this->add(array(
            'name' => 'userid',
            'type' => 'Hidden',
            'class' => 'hidden',
        ));


        $this->add(array(
            'name' => 'email',
            'required' => true,
            'type' => 'Text',
            'options' => array(
                'label' => '',
            ),
            'attributes' => array(
                'required' => 'required',
                'id' => 'email',
                'placeholder' => 'Email Address',
            ),
        ));

        $this->add(array(
            'name' => 'remove',
            'type' => 'Checkbox',
            'options' => array(
                'label' => 'Remove my email:',

            ),
            'attributes' => array(

                'id' => 'remove',
                'placeholder' => '',
                'value' => '',
                'checked' => false,

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