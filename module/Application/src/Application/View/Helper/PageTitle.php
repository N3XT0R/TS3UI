<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */


namespace Application\View\Helper;

use Zend\View\Helper\HeadTitle;

class PageTitle extends HeadTitle{
    
    protected $regKey = 'Application_View_Helper_PageTitle';
    protected $autoEscape = false;
    protected $separator = ' - ';
    
    /**
     * Get Separator
     * @return string
     */
    public function getSeparator(){
        return $this->separator;
    }
    
    /**
     * Set Separator
     * @param string $separator
     * @return \Application\View\Helper\PageTitle
     */
    public function setSeparator($separator){
        $this->separator = $separator;
        return $this;
    }
     
    public function toString($indent = null){
        $output = parent::toString($indent);
        $output = str_replace(
            array('<title>', '</title>'), array('<h2 class="page-header">', '</h2>'), $output
        );
        return $output;
    }
}
