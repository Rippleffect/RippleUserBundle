<?php

namespace Ripple\UserBundle\Tests\Entity;

use PHPUnit_Framework_TestCase;
use MyFood\UserBundle\Entity\Group;
use MyFood\UserBundle\Entity\User;

/**
 * Test to ensure the User entity behaves as expected
 *
 * @package Ripple\UserBundle\Tests\Entity
 * @author  James Halsall <jhalsall@rippleffect.com>
 */
class UserTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests the getPrimaryGroupName() method
     *
     * Ensures that null is returned when the user has no groups
     *
     * @return void
     */
    public function testGetPrimaryGroupNameReturnsNullWhenUserHasNoGroups()
    {
        $user = new User();
        $group = $user->getPrimaryGroupName();

        $this->assertNull($group, 'getPrimaryGroupName() correctly returns null when user has no groups');
    }

    /**
     * Tests the getPrimaryGroupName() method
     *
     * Ensures that the correct group name is returned when the user has multiple groups
     *
     * @return void
     */
    public function testGetPrimaryGroupNameReturnsCorrectGroupWhenUserHasMultipleGroups()
    {
        $user = new User();
        $group1 = new Group('Group1');
        $group2 = new Group('Group2');

        $user->addGroup($group1)
             ->addGroup($group2);

        $primaryGroupName = $user->getPrimaryGroupName();
        $this->assertEquals('Group1', $primaryGroupName, 'getPrimaryGroupName() returns correct group when user has multiple groups');
    }

    /**
     * Tests the getPrimaryGroupName() method
     *
     * Ensures that the correct group name is returned when we remove a user group
     *
     * @return void
     */
    public function testGetPrimaryGroupNameReturnsCorrectGroupPrimaryGroupRemoved()
    {
        $user = new User();
        $group1 = new Group('Group1');
        $group2 = new Group('Group2');
        $group3 = new Group('Group3');

        $user->addGroup($group1)
             ->addGroup($group2)
             ->addGroup($group3);

        $user->removeGroup($group1);

        $primaryGroupName = $user->getPrimaryGroupName();
        $this->assertEquals('Group2', $primaryGroupName, 'getPrimaryGroupName() returns correct group when user\'s primary group has been removed');
    }
}
