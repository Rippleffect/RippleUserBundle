<?php

namespace Ripple\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Bundle build file for the application user bundle
 *
 * @package Ripple\UserBundle\Entity
 * @author  James Halsall <jhalsall@rippleffect.com>
 */
class RippleUserBundle extends Bundle
{

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
