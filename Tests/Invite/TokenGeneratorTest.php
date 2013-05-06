<?php

namespace Ripple\UserBundle\Tests\Invite;

use Ripple\UserBundle\Invite\TokenGenerator;
use PHPUnit_Framework_TestCase;

/**
 * Tests to ensure that the token generator service for invites behaves as expected
 *
 * @package Ripple\UserBundle\Service\Invite
 * @author  James Halsall <jhalsall@rippleffect.com>
 */
class TokenGeneratorTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test to make sure that the generate() method returns a token of the correct length
     *
     * @return void
     */
    public function testGenerateReturns40CharacterToken()
    {
        $generator = new TokenGenerator();
        $token = $generator->generate();

        $this->assertEquals(40, strlen($token), 'TokenGenerator::generate() method returns token of correct length');
    }
}
