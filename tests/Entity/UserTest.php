<?php

/**
 * PHP version 7.4
 * tests/Entity/UserTest.php
 *
 * @category EntityTests
 * @package  MiW\Results\Tests
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

namespace MiW\Results\Tests\Entity;

use MiW\Results\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 *
 * @package MiW\Results\Tests\Entity
 * @group   users
 */
class UserTest extends TestCase
{
    /**
     * @var User $user
     */
    private $user;

    /**
     * Sets up the fixture.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->user = new User();
    }

    /**
     * @covers \MiW\Results\Entity\User::__construct()
     */
    public function testConstructor(): void
    {
        $testUser = new User('testUsername', 'testEmail@xyz.com', 'testPassword', true, true);

        self::assertSame(0, $testUser->getId(), 'Id is not created correctly');
        self::assertSame('testUsername', $testUser->getUsername(), 'Username is not created correctly');
        self::assertSame('testEmail@xyz.com', $testUser->getEmail(), 'Email is not created correctly');
        self::assertTrue($testUser->isEnabled(), 'Enable parameter is not created correctly');
        self::assertTrue($testUser->isAdmin(), 'Admin parameter is not created correctly');
    }

    /**
     * @covers \MiW\Results\Entity\User::getId()
     */
    public function testGetId(): void
    {
        self::assertSame(
            0,
            $this->user->getId()
        );
    }

    /**
     * @covers \MiW\Results\Entity\User::setUsername()
     * @covers \MiW\Results\Entity\User::getUsername()
     */
    public function testGetSetUsername(): void
    {
        $this->user->setUsername('testUsername');
        self::assertSame(
            'testUsername',
            $this->user->getUsername()
        );
    }

    /**
     * @covers \MiW\Results\Entity\User::getEmail()
     * @covers \MiW\Results\Entity\User::setEmail()
     */
    public function testGetSetEmail(): void
    {
        $this->user->setEmail('testEmail@xyz.com');
        self::assertSame(
            'testEmail@xyz.com',
            $this->user->getEmail()
        );
    }

    /**
     * @covers \MiW\Results\Entity\User::setEnabled()
     * @covers \MiW\Results\Entity\User::isEnabled()
     */
    public function testIsSetEnabled(): void
    {
        $this->user->setEnabled(true);
        self::assertTrue(
            $this->user->isEnabled()
        );
    }

    /**
     * @covers \MiW\Results\Entity\User::setIsAdmin()
     * @covers \MiW\Results\Entity\User::isAdmin
     */
    public function testIsSetAdmin(): void
    {
        $this->user->setIsAdmin(true);
        self::assertTrue(
            $this->user->isAdmin()
        );
    }

    /**
     * @covers \MiW\Results\Entity\User::setPassword()
     * @covers \MiW\Results\Entity\User::validatePassword()
     */
    public function testSetValidatePassword(): void
    {
        $testPassword = 'testPassword';
        $this->user->setPassword($testPassword);
        self::assertTrue(
            $this->user->validatePassword($testPassword)
        );
    }

    /**
     * @covers \MiW\Results\Entity\User::__toString()
     */
    public function testToString(): void
    {
        $this->user->setUsername('testUsername');
        $this->user->setEmail('testEmail@xyz.com');
        $this->user->setEnabled(true);
        $this->user->setIsAdmin(true);

        $testToString = '  0 -         testUsername -              testEmail@xyz.com - 1 - 1';
        self::assertSame(
            $testToString,
            $this->user->__toString()
        );
    }

    /**
     * @covers \MiW\Results\Entity\User::jsonSerialize()
     */
    public function testJsonSerialize(): void
    {
        $jsonTest = $this->user->jsonSerialize();

        self::assertArrayHasKey('id', $jsonTest, 'JsonSerialize does not have id key');
        self::assertArrayHasKey('username', $jsonTest, 'JsonSerialize does not have username key');
        self::assertArrayHasKey('email', $jsonTest, 'JsonSerialize does not have email key');
        self::assertArrayHasKey('enabled', $jsonTest, 'JsonSerialize does not have enabled key');
        self::assertArrayHasKey('admin', $jsonTest, 'JsonSerialize does not have admin key');
    }
}
