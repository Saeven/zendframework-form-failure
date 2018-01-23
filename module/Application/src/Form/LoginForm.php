<?php

namespace Application\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\Element\Text;

class LoginForm extends Form
{
    const EMAIL = 'email';

    public function __construct(string $name, array $options = [])
    {
        parent::__construct($name, $options);
    }

    public function init()
    {
        $this->add([
            'name' => 'axis',
            'type' => Text::class,
            'options' => [
                'label' => _('Test Field (Axis)'),
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'attributes' => [
                'value' => "Submit",
            ],
            'type' => Element\Submit::class,
        ]);
    }
}
