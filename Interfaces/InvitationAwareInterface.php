<?php

namespace Ripple\UserBundle\Interfaces;

use Ripple\UserBundle\Entity\Invitation;

/**
 * Invitation aware interface.
 *
 * This interface is used by all objects that contain an invitation object
 *
 * @package Ripple\UserBundle\Interfaces
 * @author  James Halsall <jhalsall@rippleffect.com>
 */
interface InvitationAwareInterface
{
    /**
     * Gets the invitation
     *
     * @return Invitation
     */
    public function getInvitation();

    /**
     * Sets the invitation
     *
     * @param Invitation $invitation The new invitation
     *
     * @return mixed
     */
    public function setInvitation(Invitation $invitation);
}
