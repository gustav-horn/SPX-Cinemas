<?php
// utilities/Encryption.php

class Encryptor {
    private static string $algo = "AES-256-CBC";
    private static string $key = "bgv c";

    public static function encrypt(string $plaintext) {
        $initialisationVector = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::$algo));
        return base64_encode($initialisationVector . openssl_encrypt($plaintext, self::$algo, self::$key, 0, $initialisationVector)); 
    }

    private static function reconstitute(array $arr){
        return array_reduce($arr, fn($carry, $item) => $carry . $item, "");
    }

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

class OptionalEncryptedData {
    private ?string $data;

    private function __construct(?string $data) {
        $this->data = $data;
    }

    public function __tostring(): string {
        return $this->data ?? "";
    }

    public function __serialize() {
        return ["data" => $this->data];
    }

    public function __unserialize(array $data) {
        $this->__construct($data["data"]);
    }

    public static function from(?string $plaintext): OptionalEncryptedData {
        if (!$plaintext) {return new self(null);}
        return new self(Encryptor::encrypt($plaintext));
    }

    public static function fromEncrypted(?string $ciphertext): OptionalEncryptedData {
        if (!$ciphertext or $ciphertext == "") {return new self(null);}
        return new self($ciphertext);
    }

    public function decrypt(): ?string {
        if (!$this->data) {return null;}
        return Encryptor::decrypt($this->data);
    }
}

class EncryptedData {
    private string $data;
    
    private function __construct(string $data) {
        $this->data = $data;
    }

    public function __tostring(): string {
        return $this->data;
    }

    public function __serialize() {
        return ["data" => $this->data];
    }

    public function __unserialize(array $data) {
        $this->__construct($data["data"]);
    }

    public static function from(string $plaintext): EncryptedData {
        return new self(Encryptor::encrypt($plaintext));
    }

    public static function fromEncrypted(string $ciphertext): EncryptedData {
        return new self($ciphertext);
    }

    public function decrypt(): string {
        return Encryptor::decrypt($this->data);
    }

}


class HashedData {
    private string $data;

    private static string $algo = PASSWORD_DEFAULT;

    private function __construct($data) {
        $this->data = $data;
    }

    public function __tostring(): string {
        return $this->data;
    }

    public function __serialize() {
        return ["data" => $this->data];
    }

    public function __unserialize(array $data) {
        $this->__construct($data["data"]);
    }

    public static function from(string $plaintext): HashedData {
        return new self(password_hash($plaintext, self::$algo));
    }

    public static function fromHashed(string $hashedValue): HashedData {
        return new self($hashedValue);
    }

    public function verify(string $comp): bool {
        return password_verify($comp, $this->data);
    }
}