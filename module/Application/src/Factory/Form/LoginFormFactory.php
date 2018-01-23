<?php

namespace Application\Factory\Form;

use Application\Form\LoginForm;
use Application\InputFilter\LoginInputFilter;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class LoginFormFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $form = new LoginForm('login');
        $form->setInputFilter(
            $container->get('InputFilterManager')->get(LoginInputFilter::class)
        );

        return $form;
    }
}