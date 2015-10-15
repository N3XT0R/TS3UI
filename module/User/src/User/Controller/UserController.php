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
use Zend\Http\PhpEnvironment\Response;
use Zend\Http\Request as HttpRequest;
use Zend\Text\Figlet\Figlet;

class UserController extends AbstractActionController{

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
    
    public function indexAction(){
        if(!$this->getUserService()->getAuthentication()->hasIdentity()){
            // Redirect to login user
            return $this->redirect()->toRoute(
                'user/action', array('action' => 'login')
            );
        }
        
        $oPaginator = $this->getUserService()->getUserList(1, 15);
        return array(
            "oUserList" => $oPaginator,
        );
    }
    
    public function loginAction(){
        $this->layout("layout/login");
        
        $oPRG = $this->prg(
            $this->url()->fromRoute("user/action", array("action" => "login")),
            true
        );
        
        if($oPRG instanceof Response){
            return $oPRG;
        }elseif($oPRG !== false){
            $oUser = $this->getUserService()->login($oPRG);
            if($oUser){
                return $this->redirect()->toRoute("user");
            }
        }
        
        $oForm = $this->getUserService()->getForm("login");
        
        
        return array(
            "oForm" => $oForm,
        );
    }
    
    public function logoutAction(){
         if ($this->getUserService()->getAuthentication()->hasIdentity()) {
            // logout with redirected data
            $this->getUserService()->logout();
        }
        
        // Redirect to user page
        return $this->redirect()->toRoute('user');
    }

    public function updateAction(){   
        return new ViewModel();
    }
    
    public function createAction(){
        
    }
    
    public function editAction(){
        $oUser = $this->getUserService()->getAuthentication()->getIdentity();
        
        $oForm = $this->getUserService()->getForm("edit");
        $oForm->setData($oUser->getArrayCopy());
        
        return array(
            "oForm" => $oForm,
        );
    }
    
    public function forbiddenAction(){
        if($this->getUserService()->getAuthentication()->hasIdentity() == false){
            $this->layout("layout/login");
        }
        return array();
    }
}
