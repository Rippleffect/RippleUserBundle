<?php

namespace Ripple\UserBundle\Invite;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\NonUniqueResultException;
use Ripple\UserBundle\Entity\Invitation;

/**
 * Invite resolver service.
 *
 * The main responsibility of the invite resolver is to determine whether or not
 * an invite and its token are still valid.
 *
 * @package MyFood\ProjectBundle\Service\Invites
 * @author  James Halsall <jhalsall@rippleffect.com>
 */
class InviteResolver
{
    /**
     * The doctrine object manager
     *
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $manager;

    /**
     * Constructor.
     *
     * @param Doctrine $doctrine The doctrine registry service
     */
    public function __construct(Doctrine $doctrine)
    {
        $this->manager = $doctrine->getManager();
    }

    /**
     * Resolves an invite by its token.
     *
     * If the given token is valid, then this method will return true. Otherwise it will return false
     *
     * @param string $inviteToken The invite token to resolve
     *
     * @return Invitation|null
     */
    public function resolve($inviteToken)
    {
        try {
            $invitation = $this->manager->getRepository('RippleUserBundle:Invitation')
                                        ->findByToken($inviteToken);
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }

        return $invitation;
    }
}
