<?php

namespace OsdCrypt\Crypt;

trait EncryptedTrait
{
    protected $isEncrypted = false;

    /** @ORM\PrePersist */
    public function encryptOnPrePersist()
    {
        if (!$this->isEncrypted) {
            $this->encryptFields();
            $this->isEncrypted = true;
        }
    }

    /** @ORM\PreUpdate */
    public function encryptOnPreUpdate()
    {
        if (!$this->isEncrypted) {
            $this->encryptFields();
            $this->isEncrypted = true;
        }
    }

    /** @ORM\PostLoad */
    public function decryptOnPostLoad()
    {
        $this->decryptFields();
        $this->isEncrypted = false;
    }

    /**
     * Loops through fields requiring encryption,
     * setting encrypted values as it goes.
     */
    public function encryptFields()
    {
        $fields = $this->getFieldsToEncrypt();

        foreach ($fields as $field) {
            $this->$field = Crypt::encrypt($this->$field);
        }
    }

    /**
     * Loops through fields requiring decryption,
     * setting decrypted values as it goes.
     */
    public function decryptFields()
    {
        $fields = $this->getFieldsToEncrypt();

        foreach ($fields as $field) {
            $this->$field = Crypt::decrypt($this->$field);
        }
    }
}
