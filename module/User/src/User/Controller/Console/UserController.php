<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace User\Controller\Console;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\Text\Figlet\Figlet;

class UserController extends AbstractConsoleController{
    
    protected $userService;
    
    public function __construct(UserServiceInterface $userService) {
        $this->setUserService($userService);
    }
    
    public function setUserService(UserServiceInterface $userService){
        $this->userService = $userService;
        return $this;
    }
    
    /**
     * 
     * @return \User\Service\UserService
     */
    public function getUserService(){
        return $this->userService;
    }
    
    public function updateAction(){
        $request = $this->getRequest();
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
