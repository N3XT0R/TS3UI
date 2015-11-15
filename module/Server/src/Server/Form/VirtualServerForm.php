<?php

namespace Server\Form;

use Zend\Form\Form;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Password;
use Zend\Form\Element\Number;
use Zend\Form\Element\Select;
use Zend\Form\Element\Button;
use Zend\Form\Element\Checkbox;

class VirtualServerForm extends Form{
    
    public function addCsrfElement($name = "token"){
        $oElement = new Csrf($name);
        $this->add($oElement);
    }
    
    public function addServerIdElement($name = "serverID"){
        $oElement = new Hidden($name);
        $this->add($oElement);
    }
    
    public function addVirtualServerIdElement($name = "virtualserver_id"){
        $oElement = new Hidden($name);
        $this->add($oElement);
    }
    
    public function addVirtualServerNameElement($name = "virtualserver_name", $label = "SERVER_VIRTUAL_NAME"){
        $oElement = new Text($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addWelcomeMessageElement($name = "virtualserver_welcomemessage", $label = "SERVER_VIRTUAL_WELCOME_MESSAGE"){
        $oElement = new Text($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addMaxClientsElement($name = "virtualserver_maxclients", $label = "SERVER_VIRTUAL_MAX_CLIENTS"){
        $oElement = new Number($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addPasswordElement($name = "virtualserver_password", $label = "SERVER_VIRTUAL_PASSWORD"){
        $oElement = new Password($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addDefaultServerGroupElement(array $aValues = array(), $name = "virtualserver_default_server_group", $label = "SERVER_VIRTUAL_DEFAULT_GROUP"){
        $oElement = new Select($name);
        $oElement->setLabel($label);
        $oElement->setValueOptions($aValues);
        $this->add($oElement);
    }
    
    public function addDefaultChannelGroupElement(array $aValues = array(), $name = "virtualserver_default_channel_group", $label = "SERVER_VIRTUAL_DEFAULT_CHANNEL_GROUP"){
        $oElement = new Select($name);
        $oElement->setLabel($label);
        $oElement->setValueOptions($aValues);
        $this->add($oElement);
    }
    
    public function addDefaultChannelAdminGroupElement(array $aValues = array(), $name = "virtualserver_default_channel_admin_group", $label = "SERVER_VIRTUAL_DEFAULT_CHANNEL_ADMIN_GROUP"){
        $oElement = new Select($name);
        $oElement->setLabel($label);
        $oElement->setValueOptions($aValues);
        $this->add($oElement);
    }
    
    public function addAutostartElement($name = "virtualserver_autostart", $label = "SERVER_VIRTUAL_AUTOSTART"){
        $oElement = new Checkbox($name);
        $oElement->setValue(1);
        $oElement->setUncheckedValue(0);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addIdentSecurityLevelElement($name = "virtualserver_needed_identity_security_level", $label = "SERVER_VIRTUAL_SECURITY_LEVEL"){
        $oElement = new Number($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addComplainAutoBanCountElement($name = "virtualserver_complain_autoban_count", $label = "SERVER_VIRTUAL_COMPLAIN_AUOTBAN_COUNT"){
        $oElement = new Number($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addComplainAutobanTimeElement($name = "virtualserver_complain_autoban_time", $label = "SERVER_VIRTUAL_COMPLAIN_AUOTBAN_TIME"){
        $oElement = new Number($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addComplainRemoveTimeElement($name = "virtualserver_complain_remove_time", $label = "SERVER_VIRTUAL_COMPLAIN_REMOVE_TIME"){
        $oElement = new Number($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addWeblistElement($name = "virtualserver_weblist_enabled", $label = "SERVER_VIRTUAL_WEBLIST"){
        $oElement = new Checkbox($name);
        $oElement->setValue(1);
        $oElement->setUncheckedValue(0);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addPortElement($name = "virtualserver_port", $label = "SERVER_VIRTUAL_PORT"){
        $oElement = new Number($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addMaxUploadBandwidthElement($name = "virtualserver_max_download_total_bandwidth", $label = "SERVER_VIRTUAL_BANDWIDTH_TOTAL_DOWNLOAD"){
        $oElement = new Number($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addMaxDownloadBandwidthElement($name = "virtualserver_max_upload_total_bandwidth", $label = "SERVER_VIRTUAL_BANDWIDTH_TOTAL_UPLOAD"){
        $oElement = new Number($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addLogClientElement($name = "virtualserver_log_client", $label = "SERVER_VIRTUAL_LOG_CLIENTS"){
        $oElement = new Checkbox($name);
        $oElement->setValue(1);
        $oElement->setUncheckedValue(0);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addLogQueryElement($name = "virtualserver_log_query", $label = "SERVER_VIRTUAL_LOG_QUERY"){
        $oElement = new Checkbox($name);
        $oElement->setValue(1);
        $oElement->setUncheckedValue(0);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addLogChannelElement($name = "virtualserver_log_channel", $label = "SERVER_VIRTUAL_LOG_CHANNEL"){
        $oElement = new Checkbox($name);
        $oElement->setValue(1);
        $oElement->setUncheckedValue(0);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addLogPermissionsElement($name = "virtualserver_log_permissions", $label = "SERVER_VIRTUAL_LOG_PERMISSIONS"){
        $oElement = new Checkbox($name);
        $oElement->setValue(1);
        $oElement->setUncheckedValue(0);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addLogServerElement($name = "virtualserver_log_server", $label = "SERVER_VIRTUAL_LOG_SERVER"){
        $oElement = new Checkbox($name);
        $oElement->setValue(1);
        $oElement->setUncheckedValue(0);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addLogFileTransferElement($name = "virtualserver_log_filetransfer", $label = "SERVER_VIRTUAL_LOG_FILETRANSFER"){
        $oElement = new Checkbox($name);
        $oElement->setValue(1);
        $oElement->setUncheckedValue(0);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addMinClientsInChannelBeforeForcedSilenceElement($name = "virtualserver_min_clients_in_channel_before_forced_silence", $label = "SERVER_VIRTUAL_MIN_CLIENTS_BEFORE_SILENCE"){
        $oElement = new Number($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addPrioritySpeakerDimmModificatorElement($name = "virtualserver_priority_speaker_dimm_modificator", $label = "SERVER_VIRTUAL_PRIORITY_SPEAKER_DIMM_MODIFICATOR"){
        $oElement = new Number($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addChannelTempDeleteDelayElement($name = "virtualserver_channel_temp_delete_delay_default", $label = "SERVER_VIRTUAL_CHANNEL_TEMP_DELETE_DELAY"){
        $oElement = new Number($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addVirtualCodedEncModeElement(array $aOptions = array(), $name = "virtualserver_codec_encryption_mode", $label = "SERVER_VIRTUAL_ENCMODE"){
        $oElement = new Select($name);
        $oElement->setValueOptions($aOptions);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    
    public function addAntifloodPointsReduceElement($name = "virtualserver_antiflood_points_tick_reduce", $label = "SERVER_VIRTUAL_ANTIFLOOD_POINTS_TICK_REDUCE"){
        $oElement = new Number($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addAntifloodPointsNeededCommandBlockElement($name = "virtualserver_antiflood_points_needed_command_block", $label = "SERVER_VIRTUAL_ANTIFLOOD_POINTS_NEEDED_COMMAND_BLOCK"){
        $oElement = new Number($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addPointsNeededIpBlockElement($name = "virtualserver_antiflood_points_needed_ip_block", $label = "SERVER_VIRTUAL_ANTIFLOOD_POINTS_NEEDED_IP_BLOCK"){
        $oElement = new Number($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addSubmitElement($name = "submit", $label = "SERVER_SAVE"){
        $oElement = new Button($name);
        $oElement->setAttribute("type", "submit");
        $oElement->setLabel($label);
        $this->add($oElement);
    }
}
