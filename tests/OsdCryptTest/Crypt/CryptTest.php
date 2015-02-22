<?php

namespace OsdCryptTest\Crypt;

use OsdCrypt\Crypt\Crypt;

class CryptTest extends \PHPUnit_Framework_TestCase
{
    protected $testString = "This is a string to encrypt";

    public function testHashReturnsAHashedString()
    {
        $hashed = Crypt::hash($this->testString);

        $this->assertEquals(64, strlen($hashed));
        $this->assertNotEquals($this->testString, $hashed);
    }

    public function testEncryptReturnsAnEncryptedString()
    {
        $encrypted = Crypt::encrypt($this->testString);

        $this->assertEquals(128, strlen($encrypted));
        $this->assertNotEquals($this->testString, $encrypted);
    }

    public function testEncryptingAndThenDecryptingReturnsTheOriginalString()
    {
        $encrypted = Crypt::encrypt($this->testString);
        $decrypted = Crypt::decrypt($encrypted);

        $this->assertEquals($this->testString, $decrypted);
    }
}