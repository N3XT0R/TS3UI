<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' =>'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'db',
                    'port'     => '3306',
                    'user'     => 'ts3ui',
                    'password' => 'ts3ui',
                    'dbname'   => 'ts3ui',
                ),
            ),
        ),
    ),
);