<?php

namespace Ripple\UserBundle\Event;

use Ripple\UserBundle\Entity\Invitation;
use Symfony\Component\EventDispatcher\Event;

/**
 * Event object for an accepted invitation.
 *
 * @package Ripple\UserBundle\Event
 * @author  James Halsall <jhalsall@rippleffect.com>
 */
class InviteAcceptedEvent extends Event
{
    /**
     * The invitation that was accepted
     *
     * @var Invitation
     */
    protected $invitation;

    /**
     * True if the event has been processed
     *
     * @var boolean
     */
    protected $processed = false;

    /**
     * The location to redirect the user to after the event has been processed
     *
     * @var string
     */
    protected $redirectUri;

    /**
     * Constructor.
     *
     * @param Invitation $invitation The invitation object that was accepted
     */
    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Gets the invitation object associated with this event
     *
     * @return Invitation
     */
    public function getInvitation()
    {
        return $this->invitation;
    }

    /**
     * Set the redirect location
     *
     * @param string $uri The new redirect URI (absolute)
     *
     * @return void
     */
    public function setRedirectUri($uri)
    {
        if (false !== $this->processed) {
            return;
        }

        $this->stopPropagation();
        $this->processed = true;
        $this->redirectUri = $uri;
    }

    /**
     * Gets the redirect location
     *
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * Returns true if the event has been processed
     *
     * @return boolean
     */
    public function isProcessed()
    {
        return $this->processed;
    }
}
