<?php
// utilities/Encryption.php

/**
 * Static class that encapsulates the basic encryption and decryption functionalities
 */
class Encryptor {
    private static string $algo = "AES-256-CBC";
    private static string $key = "bgv c";

    /**
     * encrypt encrypts a $plaintext and returns it as ciphertext
     * @param string $plaintext
     * @return string
     */
    public static function encrypt(string $plaintext) {
        $initialisationVector = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::$algo));
        return base64_encode($initialisationVector . openssl_encrypt($plaintext, self::$algo, self::$key, 0, $initialisationVector)); 
    }

    /**
     * Helper function. Basically takes a list of strings and converts it into one long string
     * @param array{string} $arr
     */
    private static function reconstitute(array $arr){
        return array_reduce($arr, fn($carry, $item) => $carry . $item, "");
    }

    /**
     * decrypt decrypts a $ciphertext and returns it as plaintext
     * @param string $ciphertext
     * @return string $plaintext
     */
    public static function decrypt(string $ciphertext) {
        // Separate the iv from the data
        $sliced = str_split(base64_decode($ciphertext), openssl_cipher_iv_length(self::$algo));
        $iv = self::reconstitute(array_splice($sliced, 0, 1));
        // Reconstitute the ciphertext
        $content = self::reconstitute($sliced);
        // Decrypt it
        return openssl_decrypt($content, self::$algo, self::$key, 0, $iv);
    }
}

/**
 * Newtype wrapper around either an encrypted string or a null value
 */
class OptionalEncryptedData {
    private ?string $data;

    /**
     * Private constructor prevents improper instantiation. Does absolutely nothing
     * @param string $data
     */
    private function __construct(?string $data) {
        $this->data = $data;
    }

    /**
     * Utility helper that returns the encrypted string as a true string
     * @return string
     */
    public function __tostring(): string {
        return $this->data ?? "";
    }

    /**
     * Utility function that converts the instanced OptionalEncryptedData into an array of its properties
     * @return array{data: string|null}
     */
    public function __serialize() {
        return ["data" => $this->data];
    }

    /**
     * Utility function that instantiates an OptionalEncryptedData from an array of its properties
     * @param array $data
     * @return void
     */
    public function __unserialize(array $data) {
        $this->__construct($data["data"]);
    }

    /**
     * Should be the default constructor. 
     * Takes a $plaintext and returns an OptionalEncryptedData having encrypted the plaintext.
     * Does no encryption if the $plaintext is null
     * @param mixed $plaintext
     * @return OptionalEncryptedData
     */
    public static function from(?string $plaintext): OptionalEncryptedData {
        if (!$plaintext) {return new self(null);}
        return new self(Encryptor::encrypt($plaintext));
    }

    /**
     * Specialised constructor. 
     * Creates an OptionalEncryptedData without encrypting the $ciphertext. 
     * Use only if the $ciphertext is already encrypted.
     * @param mixed $ciphertext
     * @return OptionalEncryptedData
     */
    public static function fromEncrypted(?string $ciphertext): OptionalEncryptedData {
        if (!$ciphertext or $ciphertext == "") {return new self(null);}
        return new self($ciphertext);
    }

    /**
     * Decrypts the internal value and returns it as a string or null. Returns the null on a null internal value.
     * @return string|null
     */
    public function decrypt(): ?string {
        if (!$this->data) {return null;}
        return Encryptor::decrypt($this->data);
    }
}

/**
 * Newtype wrapper around an encrypted string
 */
class EncryptedData {
    private string $data;
    
    /**
     * Private constructor prevents improper instantiation. Does absolutely nothing
     * @param string $data
     */
    private function __construct(string $data) {
        $this->data = $data;
    }

    /**
     * Utility helper that returns the encrypted string as a true string
     * @return string
     */
    public function __tostring(): string {
        return $this->data;
    }

    /**
     * Utility function that converts the instanced EncryptedData into an array of its properties
     * @return array{data: string}
     */
    public function __serialize() {
        return ["data" => $this->data];
    }

    /**
     * Utility function that instantiates an EncryptedData from an array of its properties
     * @param array $data
     * @return void
     */
    public function __unserialize(array $data) {
        $this->__construct($data["data"]);
    }

    /**
     * Should be the default constructor. 
     * Takes a $plaintext and returns an EncryptedData having encrypted the plaintext.
     * @param mixed $plaintext
     * @return EncryptedData
     */
    public static function from(string $plaintext): EncryptedData {
        return new self(Encryptor::encrypt($plaintext));
    }
    
    /**
     * Specialised constructor. 
     * Creates an EncryptedData without encrypting the $ciphertext. 
     * Use only if the $ciphertext is already encrypted.
     * @param mixed $ciphertext
     * @return EncryptedData
     */
    public static function fromEncrypted(string $ciphertext): EncryptedData {
        return new self($ciphertext);
    }

    /**
     * Decrypts the internal value and returns it as a string.
     * @return string
     */
    public function decrypt(): string {
        return Encryptor::decrypt($this->data);
    }

}

/**
 * Newtype wrapper around around a hashed string
 */
class HashedData {
    private string $data;

    private static string $algo = PASSWORD_DEFAULT;

    /**
     * Private constructor to prevent improper instatiation. Does literally nothing
     * @param mixed $data
     */
    private function __construct($data) {
        $this->data = $data;
    }

    /**
     * Utility helper that returns the hashed string as a true string
     * @return string
     */
    public function __tostring(): string {
        return $this->data;
    }

    /**
     * Utility function that converts the instanced HashedData into an array of its properties
     * @return array{data: string}
     */
    public function __serialize() {
        return ["data" => $this->data];
    }

    /**
     * Utility function that instantiates a HashedData from an array of its properties
     * @param array $data
     * @return void
     */
    public function __unserialize(array $data) {
        $this->__construct($data["data"]);
    }

    /**
     * Should be the default constructor. 
     * Takes a $plaintext and returns an HashedData having hashed the plaintext.
     * @param mixed $plaintext
     * @return HashedData
     */
    public static function from(string $plaintext): HashedData {
        return new self(password_hash($plaintext, self::$algo));
    }

    /**
     * Specialised constructor. 
     * Creates a HashedData without hashing the $hashedValue. 
     * Use only if the $hashedValue is already hashed.
     * @param mixed $hashedValue
     * @return HashedData
     */
    public static function fromHashed(string $hashedValue): HashedData {
        return new self($hashedValue);
    }

    /**
     * Business function that compares a string $comp with the hashed data.
     * Returns true if it matches (i.e. it is the same password as the internal value)
     * @param string $comp
     * @return bool
     */
    public function verify(string $comp): bool {
        return password_verify($comp, $this->data);
    }
}