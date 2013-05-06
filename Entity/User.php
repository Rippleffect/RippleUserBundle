<?php

namespace Ripple\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use \DateTime;

/**
 * User entity class representing a logged in user in the application
 *
 * @package Ripple\UserBundle\Entity
 * @author  James Halsall <jhalsall@rippleffect.com>
 *
 * @ORM\MappedSuperclass
 */
class User extends BaseUser
{
    /**
     * The unique identifier for this user
     *
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * The user's forename
     *
     * @var string
     * @ORM\Column(type="string", length=120)
     */
    protected $forename;

    /**
     * The user's surname
     *
     * @var string
     * @ORM\Column(type="string", length=120)
     */
    protected $surname;

    /**
     * The datetime that this user was created
     *
     * @var DateTime $created
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $created;

    /**
     * The datetime that this user was last updated
     *
     * @var DateTime $updated
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    protected $updated;

    /**
     * This user's user groups
     *
     * @var \Doctrine\Common\Collections\ArrayCollection $groups
     *
     * @ORM\ManyToMany(targetEntity="Group")
     * @ORM\JoinTable(name="users_groups",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->groups = new ArrayCollection();

        parent::__construct();
    }

    /**
     * Sets this user's forename
     *
     * @param string $forename The new forename
     *
     * @return User
     */
    public function setForename($forename)
    {
        $this->forename = $forename;

        return $this;
    }

    /**
     * Gets this user's forename
     *
     * @return string
     */
    public function getForename()
    {
        return $this->forename;
    }

    /**
     * Sets this user's surname
     *
     * @param string $surname The new surname
     *
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Gets this user's surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Gets the user's primary group name
     *
     * @return string
     */
    public function getPrimaryGroupName()
    {
        $groupNames = $this->getGroupNames();

        return array_shift($groupNames);
    }
}
