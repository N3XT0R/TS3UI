<?php
/**
 * Created by PhpStorm.
 * User: N3X-Home
 * Date: 01.03.2017
 * Time: 21:16
 */

namespace Server\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Server\Service\MessageService;

class MessageController extends AbstractActionController{

    protected $_oMessageService;

    public function setMessageService(MessageService $oMessageService){
        $this->_oMessageService = $oMessageService;
        return $this;
    }

    /**
     * @return MessageService
     */
    public function getMessageService(){
        return $this->_oMessageService;
    }

}