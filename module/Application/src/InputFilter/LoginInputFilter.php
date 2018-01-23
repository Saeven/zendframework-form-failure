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
            'name' => 'axis',
            'required' => false,
            'filters' => [
                ['name' => GarbageFilter::class],
            ],
        ]);
    }
}
