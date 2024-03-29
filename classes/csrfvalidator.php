<?php
namespace Classes;

// 参考Webページ
// http://qiita.com/mpyw/items/8f8989f8575159ce95fc
class CsrfValidator
{
    const HASH_ALGO = 'sha256';

    public static function generate()
    {
        if (session_status() === PHP_SESSION_NONE) {
            throw new \BadMethodCallException('Session is not active.');
        }
        return hash(self::HASH_ALGO, session_id());
    }

    public static function validate($token, $throw = false)
    {
        $success = self::generate() === $token;
        if (!$success && $throw) {
            throw new \RuntimeException('CSRF validation failed.', 400);
        }
        return $success;
    }
}
