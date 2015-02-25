<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2014, Ilya Beliaev
 * @since          Version 1.0
 */

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use User\Service\UserServiceInterface;
use Zend\Console\Request as ConsoleRequest;
use Zend\View\Model\ViewModel;
use Zend\Http\Request as HttpRequest;
use Zend\Text\Figlet\Figlet;
use Zend\Text\Table\Table;
use Zend\Text\Table\Row;
use Zend\Text\Table\Column;

class UserController extends AbstractActionController{

    protected $userService;
    
    public function __construct(UserServiceInterface $userService) {
        $this->setUserService($userService);
    }
    
    public function setUserService(UserServiceInterface $userService){
        $this->userService = $userService;
        return $this;
    }
    
    public function getUserService(){
        return $this->userService;
    }
    
    public function indexAction(){
        return array();
    }
    
    public function loginAction(){
        $oForm = $this->getUserService()->getForm("login");
        $this->layout("layout/login");
        return array(
            "oForm" => $oForm,
        );
    }
    
    public function logoutAction(){
        return array();
    }

    public function updateAction(){
        $request = $this->getRequest();
        if(!$request instanceof ConsoleRequest){
            
            
            return new ViewModel();
        }else{
            $needHelp = (bool)$request->getParam("help", false);
            if($needHelp){
                $figlet = new Figlet();
                echo $figlet->render("TS3UI");
                echo "\n###############################################\n\n Usage: \n";
                echo "index .php user add [username] [password]\n";
            }else{
                $mode = $request->getParam("mode");
                $params = $request->getParams()->getArrayCopy();
                
                switch($mode){
                    case "add":
                        $this->getUserService()->save($params);
                    break;
                }
            }
        }
    }
    
    public function forbiddenAction(){
        if($this->getUserService()->getAuthentication()->hasIdentiy() == false){
            $this->layout("layout/login");
        }
        return array();
    }
}
