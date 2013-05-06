<?php

namespace Ripple\UserBundle\Interfaces;

use Ripple\UserBundle\Entity\User as RippleUser;

/**
 * Interface used to ensure that an entity accepts a user object
 *
 * @package Ripple\UserBundle\Entity
 * @author  James Halsall <jhalsall@rippleffect.com>
 */
interface UserAwareInterface
{
    /**
     * Gets the user associated with this object
     *
     * @return RippleUser
     */
    public function getUser();

    /**
     * Sets the user associated with this object
     *
     * @param RippleUser $user The new user object
     *
     * @return mixed
     */
    public function setUser(RippleUser $user);
}
