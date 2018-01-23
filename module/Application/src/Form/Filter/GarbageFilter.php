<?php

namespace Application\Form\Filter;

use Zend\Filter\AbstractFilter;

class GarbageFilter extends AbstractFilter
{
    public function filter($value)
    {
        echo "<h3>GarbageFilter invoked.</h3>";
        if (!mb_check_encoding($value)) {
            echo "<h3>GarbageFilter has filtered the value.</h3>";
            return 'invalid utf8';
        }

        return $value;
    }
}