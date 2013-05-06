<?php

namespace Ripple\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\Group as BaseGroup;

/**
 * User group entity class, representing a user group in the application
 *
 * @package Ripple\UserBundle\Entity
 * @author  James Halsall <jhalsall@rippleffect.com>
 *
 * @ORM\MappedSuperclass
 */
class Group extends BaseGroup
{
    /**
     * The unique identifier of the group
     *
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * Permissions associated with this group
     *
     * @var null
     * @todo
     */
    protected $permissions;

    /**
     * Sets the identifier of this group
     *
     * @param integer $identifier The new identifier
     *
     * @return Group
     */
    public function setId($identifier)
    {
        $this->id = (int) $identifier;

        return $this;
    }

    /**
     * Gets the identifier of this group
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
