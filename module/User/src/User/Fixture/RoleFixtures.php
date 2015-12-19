<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id: c15de0af15f8974f83089c2df53dd4c56d3b1cfe $
 * $Date$
 */

namespace User\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use User\Entity\Role;

class RoleFixtures implements FixtureInterface, OrderedFixtureInterface{
    
    public function load(ObjectManager $manager) {
        //Create Guest Role
        $oGuestRole = new Role();
        $oGuestRole->setRoleId("Guest");
        $manager->persist($oGuestRole);
        $manager->flush();
        
        //Create User Role
        $oUserRole = new Role();
        $oUserRole->setRoleId("User");
        $oUserRole->setParent($oGuestRole);
        $manager->persist($oUserRole);
        $manager->flush();
        
        //Create Admin Role
        $oAdminRole = new Role();
        $oAdminRole->setRoleId("Administrator");
        $oAdminRole->setParent($oUserRole);
        $manager->persist($oAdminRole);
        $manager->flush();
    }

    public function getOrder() {
        return 1;
    }

}
