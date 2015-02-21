<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2014, Ilya Beliaev
 * @since          Version 1.0
 */

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use User\Service\UserServiceInterface;

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

}
