<?php

namespace Server\Form;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class VirtualServerEditFormFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $oForm = new VirtualServerForm("VirtualServerEdit");
        $oForm->addCsrfElement();
        $oForm->addServerIdElement();
        $oForm->addVirtualServerIdElement();
        $oForm->addVirtualServerNameElement();
        $oForm->addWelcomeMessageElement();
        $oForm->addMaxClientsElement();
        $oForm->addPasswordElement();
        $oForm->addAutostartElement();
        $oForm->addComplainAutoBanCountElement();
        $oForm->addComplainAutobanTimeElement();
        $oForm->addComplainRemoveTimeElement();
        $oForm->addDefaultServerGroupElement();
        $oForm->addDefaultChannelAdminGroupElement();
        $oForm->addDefaultChannelGroupElement();
        
        $oForm->addIdentSecurityLevelElement();
        $oForm->addWeblistElement();
        $oForm->addPortElement();
        $oForm->addMaxDownloadBandwidthElement();
        $oForm->addMaxUploadBandwidthElement();
        $oForm->addLogClientElement();
        $oForm->addLogQueryElement();
        $oForm->addLogServerElement();
        $oForm->addLogPermissionsElement();
        $oForm->addLogChannelElement();
        
        $oForm->addSubmitElement();
        
        return $oForm;
    }

}
