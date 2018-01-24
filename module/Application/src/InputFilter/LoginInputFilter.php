<?php

namespace Application\InputFilter;

use Application\Form\Validator\GarbageValidator;
use Zend\InputFilter\InputFilter;
use Application\Form\Filter\GarbageFilter;


class LoginInputFilter extends InputFilter
{
    const EMAIL = 'email';
    const RECAPTCHA = 'g-recaptcha-response';


    public function init()
    {

        $this->add([
            'name' => 'axis',
            'required' => false,
            'filters' => [
                ['name' => GarbageFilter::class],
            ],
            'validators' => [
                ['name' => GarbageValidator::class],
            ],
        ]);
    }
}
