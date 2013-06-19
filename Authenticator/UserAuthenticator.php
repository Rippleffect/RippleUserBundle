<?php

namespace Ripple\UserBundle\Authenticator;

use Ripple\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

/**
 * User authenticator.
 *
 * This class is responsible for programatically authenticating a user in the application
 *
 * @package Ripple\UserBundle\Authenticator
 * @author  James Halsall <jhalsall@rippleffect.com>
 */
class UserAuthenticator
{
    /**
     * The security context
     *
     * @var SecurityContext
     */
    protected $securityContext;

    /**
     * The event dispatcher
     *
     * @var ContainerAwareEventDispatcher
     */
    protected $dispatcher;

    /**
     * The service container
     *
     * @var Container
     */
    protected $container;

    /**
     * Constructor.
     *
     * @param SecurityContext               $context    The security context service
     * @param ContainerAwareEventDispatcher $dispatcher The event dispatcher
     * @param Container                     $container  The service container (used to fetch the request object)
     */
    public function __construct(SecurityContext $context, ContainerAwareEventDispatcher $dispatcher, Container $container)
    {
        $this->securityContext = $context;
        $this->dispatcher = $dispatcher;
        $this->container = $container;
    }

    /**
     * Attempts to authenticate a user in the application
     *
     * @param User $user The user to authenticate
     *
     * @return void
     */
    public function authenticate(User $user)
    {
        $token = new UsernamePasswordToken($user, $user->getPassword(), "main", $user->getRoles());
        $this->securityContext->setToken($token);
        $request = $this->container->get('request');

        $event = new InteractiveLoginEvent($request, $token);
        $this->dispatcher->dispatch('security.interactive_login', $event);
    }

    /**
     * Invalidates the user in the application.
     *
     * @param User $user The user to invalidate
     *
     * @return void
     */
    public function invalidate(User $user)
    {
        $this->container->get('request')->getSession()->invalidate();
        $this->securityContext->setToken(null);
    }
}
