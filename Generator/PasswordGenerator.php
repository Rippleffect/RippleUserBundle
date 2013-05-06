<?php

namespace Ripple\UserBundle\Generator;

use InvalidArgumentException;

/**
 * Password generator.
 *
 * Provides functionality for generating passwords for user accounts
 *
 * @package Ripple\UserBundle\Generator
 * @author  James Halsall <jhalsall@rippleffect.com>
 */
class PasswordGenerator
{
    const MIN_PASSWORD_LENGTH = 6;
    const MAX_PASSWORD_LENGTH = 32;
    const MIN_CHARACTER_MAP_LENGTH = 20;

    /**
     * An available set of characters for use in the generated password
     *
     * @var string
     */
    protected $characterMap = '';

    /**
     * Returns a random plaintext password,
     *
     * @param integer $length The desired length of the password (min and max values apply, see class constants)
     *
     * @return string
     *
     * @throws InvalidArgumentException If the $length parameter is empty or does not fit inside max and min boundaries
     *
     * @see PasswordGenerator::MIN_PASSWORD_LENGTH
     * @see PasswordGenerator::MAX_PASSWORD_LENGTH
     */
    public function generate($length = 12)
    {
        if (empty($length)) {
            throw new InvalidArgumentException(
                sprintf('Empty $length parameter provided in %s on line %d', __CLASS__, __LINE__)
            );
        }

        if (static::MAX_PASSWORD_LENGTH < $length || $length < static::MIN_PASSWORD_LENGTH) {
            throw new InvalidArgumentException(
                sprintf('$length parameter must be between %d and %d', static::MIN_PASSWORD_LENGTH, static::MAX_PASSWORD_LENGTH)
            );
        }

        $characterMap = $this->getCharacterMap(true);
        $mapItems = count($characterMap) - 1;
        $password = array();
        $passwordLength = $length;
        while ($passwordLength--) {
            $password[] = $characterMap[rand(0, $mapItems)];
        }

        $generatedPassword = implode('', $password);

        return $generatedPassword;
    }

    /**
     * Updates the character map with a new set of valid characters
     *
     * @param string $characters The new character map
     *
     * @return void
     *
     * @throws InvalidArgumentException If the $characters parameter is empty or does not meet minumum length
     *
     * @see PasswordGenerator::MIN_CHARACTER_MAP_LENGTH
     */
    public function setCharacterMap($characters)
    {
        if (empty($characters)) {
            throw new InvalidArgumentException('An empty set of characters was provided');
        }

        // remove duplicate characters from the string
        $characterArray = str_split($characters);
        $characters = implode('', array_unique($characterArray));

        if (strlen($characters) < static::MIN_CHARACTER_MAP_LENGTH) {
            throw new InvalidArgumentException(
                sprintf('You must provide at least %d unique characters in the character map', static::MIN_CHARACTER_MAP_LENGTH)
            );
        }

        $this->characterMap = $characters;
    }

    /**
     * Gets the current character map
     *
     * @param boolean $asArray True to return the character map as an array, defaults to false
     *
     * @return string|array
     */
    public function getCharacterMap($asArray = false)
    {
        if (empty($this->characterMap)) {
            $this->loadDefaultCharacterMap();
        }

        if (false !== $asArray) {
            return str_split($this->characterMap);
        }

        return $this->characterMap;
    }

    /**
     * Loads a default character map
     *
     * @return void
     */
    protected function loadDefaultCharacterMap()
    {
        $this->setCharacterMap('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
    }
}
