<?php

namespace App\Helpers;

class JwtHelper
{
    public static function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public static function base64UrlDecode(string $data): string|false
    {
        $padding = 4 - (strlen($data) % 4);
        if ($padding < 4) {
            $data .= str_repeat('=', $padding);
        }
        return base64_decode(strtr($data, '-_', '+/'));
    }

    public static function encode(array $payload, string $secret): string
    {
        $header = ['typ' => 'JWT', 'alg' => 'HS256'];
        $segments = [
            self::base64UrlEncode(json_encode($header)),
            self::base64UrlEncode(json_encode($payload)),
        ];
        $signature = hash_hmac('sha256', implode('.', $segments), $secret, true);
        $segments[] = self::base64UrlEncode($signature);
        return implode('.', $segments);
    }

    public static function decode(string $token, string $secret): ?array
    {
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            return null;
        }
        [$headb64, $payloadb64, $sigb64] = $parts;
        $signature = self::base64UrlDecode($sigb64);
        $data = $headb64 . '.' . $payloadb64;
        $valid = hash_equals($signature, hash_hmac('sha256', $data, $secret, true));
        if (!$valid) {
            return null;
        }
        $payload = json_decode(self::base64UrlDecode($payloadb64), true);
        return is_array($payload) ? $payload : null;
    }
}