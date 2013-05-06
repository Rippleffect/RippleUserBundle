<?php

namespace Ripple\UserBundle\Controller;

use Ripple\UserBundle\Event\InviteAcceptedEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Invite controller.
 *
 * Used for handling invitations sent out to users
 *
 * @package Ripple\UserBundle\Controller
 * @author  James Halsall <jhalsall@rippleffect.com>
 */
class InviteController extends Controller
{
    /**
     * Entry point for invitations.
     *
     * When a user hits an invite URL, this action will dispatch the event across
     * the application so that other bundles can handle it
     *
     * @param string $token The invite token from the request
     *
     * @throws NotFoundHttpException If the invitation token in the request is not valid
     *
     * @return RedirectResponse
     */
    public function indexAction($token)
    {
        /** @var \Ripple\UserBundle\Service\InviteResolver $inviteResolver */
        $inviteResolver = $this->get('ripple_user.invite_resolver');
        $invitation = $inviteResolver->resolve($token);

        $event = new InviteAcceptedEvent($invitation);
        $this->get('event_dispatcher')->dispatch('ripple_user.invite_accepted', $event);

        if (true !== $event->isProcessed()) {
            throw $this->createNotFoundException('The invitation token you have provided is not valid');
        }

        $redirectUri = $event->getRedirectUri();

        return $this->redirect($redirectUri);
    }
}
