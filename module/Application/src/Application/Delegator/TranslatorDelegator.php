<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace Application\Delegator;

use Zend\I18n\Translator\Resources;
use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Http\PhpEnvironment\Request;

class TranslatorDelegator implements DelegatorFactoryInterface{
    
    public function createDelegatorWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName, $callback) {
       /* @var $translator \Zend\I18n\Translator\Translator */
       $translator = $callback();
       $translator->addTranslationFilePattern(
           'phpArray',
           Resources::getBasePath(),
           Resources::getPatternForValidator()
       );
       $translator->addTranslationFilePattern(
           'phpArray',
           Resources::getBasePath(),
           Resources::getPatternForCaptcha()
       );
       
       $oRequest = $serviceLocator->get("Request");
       if($oRequest instanceof Request){
           $sLang = $oRequest->getServer()->get("HTTP_ACCEPT_LANGUAGE");
           $sLangISO =  \Locale::acceptFromHttp($sLang);
           $translator->setLocale(\Locale::getPrimaryLanguage($sLangISO));
       }
       
       $translator->setFallbackLocale("en");
       return $translator;
    }

}
