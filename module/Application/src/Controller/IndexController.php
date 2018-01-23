<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Form\LoginForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $form;

    public function __construct(LoginForm $loginForm)
    {
        $this->form = $loginForm;
    }

    public function indexAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate('application/index/login');
        $viewModel->setVariable('loginForm', $this->form);

        if ($this->getRequest()->isPost()) {
            $this->form->setData($this->params()->fromPost());
            if ($this->form->isValid()) {
                echo "<h1>The form was successfully submitted, and was valid.</h1>";
            }

            echo "<pre>The submitted axis value was " . $this->form->get('axis')->getValue() . ".</pre>";
        }


        return $viewModel;
    }
}
