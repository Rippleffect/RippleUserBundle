<?php

namespace Ripple\UserBundle\Tests\Generator;

use PHPUnit_Framework_TestCase;
use Ripple\UserBundle\Generator\PasswordGenerator;

/**
 * Tests to ensure the behaviour of the PasswordGenerator class is as we expect
 *
 * @package Ripple\UserBundle\Tests\Generator
 * @author  James Halsall <jhalsall@rippleffect.com>
 */
class PasswordGeneratorTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests setCharacterMap() method
     *
     * Ensures that an exception is thrown when providing a character map that does not
     * meet the minimum specified in the class
     *
     * @return void
     */
    public function testSetCharacterMapThrowsExceptionForSmallCharacterMap()
    {
        $this->setExpectedException('InvalidArgumentException');

        $generator = new PasswordGenerator();
        $generator->setCharacterMap('abcdef');
    }

    /**
     * Tests setCharacterMap() method
     *
     * Ensures that an exception is thrown when providing an empty character map
     *
     * @return void
     */
    public function testSetCharacterMapThrowsExceptionForEmptyCharacterMap()
    {
        $this->setExpectedException('InvalidArgumentException');

        $generator = new PasswordGenerator();
        $generator->setCharacterMap('');
    }


    /**
     * Tests setCharacterMap() method
     *
     * Ensures that a valid character map is correctly accepted and returned
     *
     * @return void
     */
    public function testSetCharacterMapAcceptsValidCharacterMap()
    {
        $generator = new PasswordGenerator();
        $map = 'abcdefghijklmnopqrstu()*&^%!"£$';
        $generator->setCharacterMap($map);

        $this->assertEquals($map, $generator->getCharacterMap(), 'setCharacterMap() accepts valid character map');
    }

    /**
     * Tests getCharacterMap() method
     *
     * Ensures that character map is correctly returned as an array when requested
     *
     * @return void
     */
    public function testGetCharacterMapReturnsMapAsArray()
    {
        $generator = new PasswordGenerator();
        $this->assertInternalType('array', $generator->getCharacterMap(true), 'getCharacterMap() correctly returns map as array when requested');
    }

    /**
     * Tests getCharacterMap() method
     *
     * Ensures that character map is correctly returned as a string when requested
     *
     * @return void
     */
    public function testGetCharacterMapReturnsMapAsString()
    {
        $generator = new PasswordGenerator();
        $this->assertInternalType('string', $generator->getCharacterMap(), 'getCharacterMap() correctly returns map as string when requested');
    }

    /**
     * Tests generate() method
     *
     * Ensures exception is thrown for an empty $length parameter
     *
     * @return void
     */
    public function testGenerateThrowsExceptionForEmptyLengthParameter()
    {
        $this->setExpectedException('InvalidArgumentException');

        $generator = new PasswordGenerator();
        $generator->generate('');
    }

    /**
     * Tests generate() method
     *
     * Ensures exception is thrown for $length parameter that is too large
     *
     * @return void
     */
    public function testGenerateThrowsExceptionForLengthParameterExceedingMax()
    {
        $this->setExpectedException('InvalidArgumentException');

        $generator = new PasswordGenerator();
        $generator->generate(PasswordGenerator::MAX_PASSWORD_LENGTH + 1);
    }

    /**
     * Tests generate() method
     *
     * Ensures that exception is thrown for $length parameter that is too small
     *
     * @return void
     */
    public function testGenerateThrowsExceptionForLengthParameterBelowMin()
    {
        $this->setExpectedException('InvalidArgumentException');

        $generator = new PasswordGenerator();
        $generator->generate(PasswordGenerator::MIN_PASSWORD_LENGTH - 1);
    }

    /**
     * Tests generate() method
     *
     * Ensures that a password is generated of the correct length
     *
     * @return void
     */
    public function testGenerateReturnsPasswordOfCorrectLength()
    {
        $generator = new PasswordGenerator();
        $password = $generator->generate(12);

        $this->assertEquals(12, strlen($password), 'generate() returns password of correct length');
    }

    /**
     * Tests generate() method
     *
     * Ensures that when the max and min $length parameter is provided, it does not throw an exception
     *
     * @return void
     */
    public function testGenerateDoesNotThrowExceptionForEdgeCaseLengths()
    {
        $generator = new PasswordGenerator();
        $maxPassword = $generator->generate(PasswordGenerator::MAX_PASSWORD_LENGTH);
        $minPassword = $generator->generate(PasswordGenerator::MIN_PASSWORD_LENGTH);

        $this->assertEquals(PasswordGenerator::MAX_PASSWORD_LENGTH, strlen($maxPassword), 'generate() accepts MAX password length');
        $this->assertEquals(PasswordGenerator::MIN_PASSWORD_LENGTH, strlen($minPassword), 'generate() accepts MIN password length');
    }
}
