<?php

namespace Application\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\StringLength;
use Application\Form\Filter\GarbageFilter;


class LoginInputFilter extends InputFilter
{
    const EMAIL = 'email';
    const RECAPTCHA = 'g-recaptcha-response';


    public function init()
    {

        $this->add([
            'name' => 'email',
            'required' => true,
            'filters' => [
                ['name' => StringTrim::class],
                ['name' => StripTags::class],
            ],
        ]);

        $this->add([
            'name' => 'password',
            'required' => true,
            'filters' => [
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'message' => _("Your password must be at least 8 characters long"),
                        'min' => 8,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'axis',
            'required' => false,
            'filters' => [
                ['name' => GarbageFilter::class],
            ],
        ]);
    }
}
