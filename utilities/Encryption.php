<?php
// utilities/Encryption.php

class Encryptor {
    private static string $algo = "AES-256-GCM";
    private static string $key = "bgv c";
    private static string $hashAlgo = PASSWORD_BCRYPT;

    public static function encrypt(string $plaintext): string {
        $initialisationVector = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::$algo));
        return $initialisationVector . openssl_encrypt($plaintext, self::$algo, self::$key, 0, $initialisationVector);
    }

    public static function decrypt(string $ciphertext): string {
        $sliced = str_split($ciphertext, openssl_cipher_iv_length(self::$algo));
        $iv = array_splice($sliced, 0, 1);
        $content = array_reduce($sliced, fn($carry, $item) => $carry . $item, "");
        return openssl_decrypt($content, self::$algo, self::$key, 0, $iv);
    }

    public static function hash(string $plaintext): string {
        return password_hash($plaintext, self::$hashAlgo);
    }
}