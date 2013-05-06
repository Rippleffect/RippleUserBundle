<?php

namespace Ripple\UserBundle\Entity\Repository;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityRepository;
use Ripple\UserBundle\Entity\Invitation;

/**
 * Invitation repository.
 *
 * Provides methods for fetching and manipulating data
 *
 * @package Ripple\UserBundle\Entity\Repository
 * @author  James Halsall <jhalsall@rippleffect.com>
 */
class InvitationRepository extends EntityRepository
{
    /**
     * Finds an invitation entity by its token value
     *
     * @param string $token The invitation token used to fetch the invite
     *
     * @return Invitation
     */
    public function findByToken($token)
    {
        $invitation = $this->getEntityManager()
                           ->createQuery(
                               'SELECT i FROM Ripple\UserBundle\Entity\Invitation i
                                WHERE i.token = :token'
                           )
                           ->setParameter('token', $token)
                           ->getSingleResult();

        return $invitation;
    }
}
