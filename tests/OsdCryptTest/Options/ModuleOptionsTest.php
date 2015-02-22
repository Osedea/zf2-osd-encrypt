<?php

namespace OsdCryptTest\Options;

use OsdCrypt\Options\ModuleOptions;

class ModuleOptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ModuleOptions $options
     */
    protected $options;

    public function setUp()
    {
        $options = new ModuleOptions;

        $this->options = $options;
    }

    /**
     * @covers OsdCrypt\Options\ModuleOptions::setCryptKeyLocator
     * @covers OsdCrypt\Options\ModuleOptions::getCryptKeyLocator
     */
    public function testSetCryptKeyLocator()
    {
        $this->options->setCryptKeyLocator('test');
        $this->assertEquals('test', $this->options->getCryptKeyLocator());
    }

    /**
     * @covers OsdCrypt\Options\ModuleOptions::setHashAlgorithm
     * @covers OsdCrypt\Options\ModuleOptions::getHashAlgorithm
     */
    public function testSetHashAlgorithm()
    {
        $this->options->setHashAlgorithm('test');
        $this->assertEquals('test', $this->options->getHashAlgorithm());
    }

    /**
     * @covers OsdCrypt\Options\ModuleOptions::setEncryptionLibrary()
     * @covers OsdCrypt\Options\ModuleOptions::getEncryptionLibrary()
     */
    public function testSetEncryptionLibrary()
    {
        $this->options->setEncryptionLibrary('test');
        $this->assertEquals('test', $this->options->getEncryptionLibrary());
    }

    /**
     * @covers OsdCrypt\Options\ModuleOptions::setEncryptionAlgorithm()
     * @covers OsdCrypt\Options\ModuleOptions::getEncryptionAlgorithm()
     */
    public function testSetEncryptionAlgorithm()
    {
        $this->options->setEncryptionAlgorithm('test');
        $this->assertEquals('test', $this->options->getEncryptionAlgorithm());
    }
}
