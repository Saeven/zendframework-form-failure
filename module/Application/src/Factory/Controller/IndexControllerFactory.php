<?php

namespace Application\Factory\Controller;

use Application\Controller\IndexController;
use Application\Form\LoginForm;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new IndexController(
            $container->get('FormElementManager')->get(LoginForm::class)
        );
    }
}

