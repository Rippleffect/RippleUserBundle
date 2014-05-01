<?php

namespace Ripple\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * An entity representing an invite sent out to an email address.
 *
 * Usually another entity will have a relationship with an Invitation providing some more semantic meaning.
 *
 * @package Ripple\UserBundle\Entity
 * @author  James Halsall <jhalsall@rippleffect.com>
 *
 * @ORM\Entity(repositoryClass="Ripple\UserBundle\Entity\Repository\InvitationRepository")
 * @ORM\Table(name="invitations", uniqueConstraints={@ORM\UniqueConstraint(name="token_idx", columns={"token"})})
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class Invitation
{
    /**
     * The unique identifier of the invitation
     *
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * The unique token that verifies the recipient
     *
     * @var string $token
     * @ORM\Column(type="string", length=40)
     */
    protected $token;

    /**
     * The forename of the recipient
     *
     * @var string $forename
     * @ORM\Column(type="string", length=120)
     */
    protected $forename;

    /**
     * The surname of the recipient
     *
     * @var string $surname
     * @ORM\Column(type="string", length=120)
     */
    protected $surname;

    /**
     * The email address of the recipient
     *
     * @var string $email
     * @ORM\Column(type="string", length=120)
     */
    protected $email;

    /**
     * The time that this project was deleted (if any)
     *
     * @var string
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    protected $deletedAt;

    /**
     * Gets the identifier of this invitation
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the email address for this invitation
     *
     * @param string $email The new email address
     *
     * @return Invitation
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the email address for this invitation
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the recipients forename
     *
     * @param string $forename The recipients forename
     *
     * @return Invitation
     */
    public function setForename($forename)
    {
        $this->forename = $forename;

        return $this;
    }

    /**
     * Gets the recipients forename
     *
     * @return string
     */
    public function getForename()
    {
        return $this->forename;
    }

    /**
     * Sets the recipients surname
     *
     * @param string $surname The recipients surname
     *
     * @return Invitation
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Gets the recipients surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Sets the unique token for this invitation
     *
     * @param string $token The token for the invite
     *
     * @return Invitation
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Gets the unique token associated with this invitation
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Sets the "deleted at" date time
     *
     * @param \DateTime $deletedAt The date time that this object was deleted
     *
     * @return Invitation
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Gets the "deleted at" date and time
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
}
