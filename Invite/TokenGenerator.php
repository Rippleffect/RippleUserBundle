<?php

namespace Ripple\UserBundle\Invite;

/**
 * Token generator service for invitations.
 *
 * Responsible for generating unique invitation tokens for user invites
 *
 * @package Ripple\UserBundle\Invite
 * @author  James Halsall <jhalsall@rippleffect.com>
 */
class TokenGenerator
{
    /**
     * Generates a new 40 character token for an invite
     *
     * @return string
     */
    public function generate()
    {
        $uniqueId = uniqid(mt_rand(0, time())) . time();
        $token = sha1($uniqueId);

        return $token;
    }
}
