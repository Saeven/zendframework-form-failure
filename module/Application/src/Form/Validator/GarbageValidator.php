<?php

namespace Application\Form\Validator;


use Zend\Validator\AbstractValidator;

class GarbageValidator extends AbstractValidator
{

    public function isValid($value)
    {
        echo "<h3>GarbageValidator invoked.</h3>";
        return mb_check_encoding($value);
    }
}
