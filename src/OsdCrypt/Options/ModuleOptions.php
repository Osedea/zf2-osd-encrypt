<?php

namespace OsdCrypt\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{
    protected $cryptKeyLocator;

    protected $hashAlgorithm;

    protected $encryptionLibrary;

    protected $encryptionAlgorithm;

    /**
     * @return mixed
     */
    public function getCryptKeyLocator()
    {
        return $this->cryptKeyLocator;
    }

    /**
     * @param mixed $cryptKeyLocator
     */
    public function setCryptKeyLocator($cryptKeyLocator)
    {
        $this->cryptKeyLocator = $cryptKeyLocator;
    }

    /**
     * @return mixed
     */
    public function getHashAlgorithm()
    {
        return $this->hashAlgorithm;
    }

    /**
     * @param mixed $hashAlgorithm
     */
    public function setHashAlgorithm($hashAlgorithm)
    {
        $this->hashAlgorithm = $hashAlgorithm;
    }

    /**
     * @return mixed
     */
    public function getEncryptionLibrary()
    {
        return $this->encryptionLibrary;
    }

    /**
     * @param mixed $encryptionLibrary
     */
    public function setEncryptionLibrary($encryptionLibrary)
    {
        $this->encryptionLibrary = $encryptionLibrary;
    }

    /**
     * @return mixed
     */
    public function getEncryptionAlgorithm()
    {
        return $this->encryptionAlgorithm;
    }

    /**
     * @param mixed $encryptionAlgorithm
     */
    public function setEncryptionAlgorithm($encryptionAlgorithm)
    {
        $this->encryptionAlgorithm = $encryptionAlgorithm;
    }
}
