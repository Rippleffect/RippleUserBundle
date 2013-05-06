<?php

namespace Ripple\UserBundle\Listener;

use Ripple\UserBundle\Event\InviteAcceptedEvent;

/**
 * Basic invite listener.
 *
 * This invite listener is simply meant as a fallback to prompt for a real implementation
 * of invite handling.
 *
 * @package Ripple\UserBundle\Listener
 * @author  James Halsall <jhalsall@rippleffect.com>
 */
class InviteListener
{
    /**
     * Handles the invite accepted event.
     *
     * This method should never be called, if it does get called it means that no real
     * handler has been successful at handling the invitation acceptance, so we redirect
     * the user back to the root of the site.
     *
     * TODO: handle this event by redirecting the user to a registration form to complete their invite
     *
     * @param InviteAcceptedEvent $event The event object
     *
     * @return void
     */
    public function onInviteAccepted(InviteAcceptedEvent $event)
    {
        $event->setRedirectUri('/');
    }
}
