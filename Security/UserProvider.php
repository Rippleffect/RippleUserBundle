<?php

namespace Ripple\UserBundle\Security;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Ripple\UserBundle\Entity\User;
use FOS\UserBundle\Doctrine\UserManager;

/**
 * User provider implementation.
 *
 * Provides functionality for providing user information to Symfony's
 * security component
 *
 * @package Ripple\UserBundle\Security
 * @author  James Halsall <jhalsall@rippleffect.com>
 */
class UserProvider implements UserProviderInterface
{
    /**
     * The user manager
     *
     * @var UserManager
     */
    protected $manager;

    /**
     * The entity manager
     *
     * @var EntityManager
     */
    private $em;

    /**
     * Constructor.
     *
     * @param EntityManager $em      The entity manager
     * @param UserManager   $manager The user manager
     */
    public function __construct(EntityManager $em, UserManager $manager)
    {
        $this->em = $em;
        $this->manager = $manager;
    }

    /**
     * Loads the user for the given username.
     *
     * @param string $username The username
     *
     * @return UserInterface
     *
     * @throws UsernameNotFoundException If the user is not found
     *
     */
    public function loadUserByUsername($username)
    {
        $user = $this->manager->findUserByUsernameOrEmail($username);

        if (!$user) {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }

        return $user;
    }

    /**
     * Refreshes the user for the account interface.
     *
     * @param UserInterface $user
     *
     * @return UserInterface
     *
     * @throws UnsupportedUserException  If the account is not supported
     * @throws UsernameNotFoundException If the username does not exist
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Expected an instance of Ripple\UserBundle\Entity\User, but got "%s".', get_class($user))
            );
        }

        $id = $this->em->getClassMetadata('MyFoodUserBundle:User')->getIdentifierValues($user);
        $reloadedUser = $this->manager->findUserBy($id);
        if (null === $reloadedUser) {
            throw new UsernameNotFoundException(sprintf('User with ID "%d" could not be reloaded.', $user->getId()));
        }

        return $reloadedUser;
    }

    /**
     * Whether this provider supports the given user class
     *
     * @param string $class
     *
     * @return boolean
     */
    public function supportsClass($class)
    {
        $userClass = $this->manager->getClass();

        return $userClass === $class || is_subclass_of($class, $userClass);
    }
}