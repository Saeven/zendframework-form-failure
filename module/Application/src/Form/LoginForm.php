<?php

namespace Application\Form;

use CirclicalRecaptcha\Form\Element\Recaptcha;
use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Password;
use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\InputFilter;

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
            'name' => self::EMAIL,
            'type' => Text::class,
            'options' => [
                'label' => _('Username or email'),
                'label_attributes' => ['for' => self::EMAIL, 'class' => 'control-label fly-label drop'],
            ],
            'attributes' => [
                'placeholder' => _('Username or email'),
                'maxlength' => 254,
            ],
        ]);

        $this->add([
            'name' => 'password',
            'type' => Password::class,
            'options' => [
                'label' => _("Password"),
                'label_attributes' => ['for' => 'password', 'class' => 'control-label fly-label drop'],
            ],
            'attributes' => [
                'class' => 'fly-input',
                'placeholder' => _('Password'),
                'maxlength' => 24,
                'autocomplete' => 'off',
            ],
        ]);

        $this->add([
            'name' => 'axis',
            'type' => Hidden::class,
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
