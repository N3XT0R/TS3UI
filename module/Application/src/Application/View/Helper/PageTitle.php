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
    protected $separator = ' &raquo; ';
    
    public function toString($indent = null){
        $output = parent::toString($indent);
        $output = str_replace(
            array('<title>', '</title>'), array('<h1 class="page-header">', '</h1>'), $output
        );
        
        return $output;
    }
}
