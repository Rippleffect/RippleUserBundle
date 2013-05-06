<?php

namespace Ripple\UserBundle\Tests\Event\InviteAcceptedEvent;

use PHPUnit_Framework_TestCase;
use Ripple\UserBundle\Entity\Invitation;
use Ripple\UserBundle\Event\InviteAcceptedEvent;

/**
 * Tests for the invite accepted event
 *
 * @package Ripple\UserBundle\Tests\Event\InviteAcceptedEvent;
 * @author  James Halsall <jhalsall@rippleffect.com>
 */
class InviteAcceptedEventTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that makes sure the getInvitation() method returns the correct invite
     *
     * @return void
     */
    public function testGetInvitationReturnsInvitation()
    {
        $invite = new Invitation();
        $event = new InviteAcceptedEvent($invite);

        $this->assertEquals($invite, $event->getInvitation(), 'Invite fetched from InviteAcceptedEvent is correct');
    }

    /**
     * Test that makes sure the isProcessed() method returns true in the right scenario
     *
     * @return void
     */
    public function testIsProcessedCorrectlyReturnsTrue()
    {
        $invite = new Invitation();
        $event = new InviteAcceptedEvent($invite);

        $event->setRedirectUri('/');
        $this->assertTrue($event->isProcessed(), 'InviteAcceptedEvent::isProcessed() correctly returns true after setting URI');
    }

    /**
     * Test that makes sure the isProcessed() method returns false in the right scenario
     *
     * @return void
     */
    public function testIsProcessedCorrectlyReturnsFalse()
    {
        $invite = new Invitation();
        $event = new InviteAcceptedEvent($invite);

        $this->assertFalse(
            $event->isProcessed(),
            'InviteAcceptedEvent::isProcessed() correctly returns false after setting URI'
        );
    }

    /**
     * Test that makes sure the event will still propagate before setting the URI
     *
     * @return void
     */
    public function testIsPropagationStoppedIsFalseBeforeSettingUri()
    {
        $invite = new Invitation();
        $event = new InviteAcceptedEvent($invite);

        $this->assertFalse(
            $event->isPropagationStopped(),
            'InviteAcceptedEvent::isPropagationStopped() correctly returns false after setting URI'
        );
    }

    /**
     * Test that makes sure the event will not propagate after setting the URI
     *
     * @return void
     */
    public function testIsPropagationStoppedIsTrueAfterSettingUri()
    {
        $invite = new Invitation();
        $event = new InviteAcceptedEvent($invite);
        $event->setRedirectUri('/');

        $this->assertTrue(
            $event->isPropagationStopped(),
            'InviteAcceptedEvent::isPropagationStopped() correctly returns true after setting URI'
        );
    }

    /**
     * Test that makes sure the setRedirectUri() method does not update the URI after it is already processed
     *
     * @return void
     */
    public function testSetRedirectUriDoesNotUpdateRedirectUriAfterEventIsProcessed()
    {
        $invite = new Invitation();
        $event = new InviteAcceptedEvent($invite);
        $event->setRedirectUri('/');

        $this->assertEquals('/', $event->getRedirectUri());
        $event->setRedirectUri('/should-not-work');
        $this->assertEquals('/', $event->getRedirectUri());
    }
}
