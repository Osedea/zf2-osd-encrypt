<?php

namespace OsdCrypt\Crypt;

interface EncryptedInterface
{
    /**
     * @return mixed
     */
    public function encryptOnPrePersist();

    /**
     * @return mixed
     */
    public function encryptOnPreUpdate();

    /**
     * @return mixed
     */
    public function decryptOnPostLoad();

    /**
     * @return mixed
     */
    public function getFieldsToEncrypt();
}
