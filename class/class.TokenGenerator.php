<?php
require_once __DIR__.'/../lib/jwt/src/BeforeValidException.php';
require_once __DIR__.'/../lib/jwt/src/ExpiredException.php';
require_once __DIR__.'/../lib/jwt/src/SignatureInvalidException.php';
require_once __DIR__.'/../lib/jwt/src/JWT.php';

use \Firebase\JWT\JWT;

class TokenGenerator {
    private $key = "E4AeJeqB2vq7Op5sbTRW9FqyhxwaHXue3p2lLJy4sGnbBby7vJD5Tu6hTtBbmsu";

    public function __construct($key = 0) {
        if ($key != 0) {
            $this->key = $key;
        }
    }

    public function generateToken($data) {
        $jwt = JWT::encode($data, $this->key);
        return $jwt;
    }

    public function decodeToken($token) {
        $decoded = JWT::decode($token, $this->key, array('HS256'));
        return (array)$decoded;
    }
}

?>
