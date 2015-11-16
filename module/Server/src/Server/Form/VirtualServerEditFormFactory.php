<?php

namespace Server\Form;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use TSCore\Enum\CodecEncryptionMode;

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
        $oForm->addMinClientsInChannelBeforeForcedSilenceElement();
        $oForm->addPrioritySpeakerDimmModificatorElement();
        $oForm->addChannelTempDeleteDelayElement();
        $oForm->addVirtualCodedEncModeElement(array(
            CodecEncryptionMode::CODEC_CRYPT_INDIVIDUAL     => 'SERVER_VIRTUAL_ENCMODE_INDIVIDUAL',
            CodecEncryptionMode::CODEC_CRYPT_DISABLED       => 'SERVER_VIRTUAL_ENCMODE_GLOBAL_OFF',
            CodecEncryptionMode::CODEC_CRYPT_ENABLED        => 'SERVER_VIRTUAL_ENCMODE_GLOBAL_ON',
        ));
        
        $oForm->addAntifloodPointsReduceElement();
        $oForm->addAntifloodPointsNeededCommandBlockElement();
        $oForm->addPointsNeededIpBlockElement();
        $oForm->addSubmitElement();
        
        return $oForm;
    }

}
