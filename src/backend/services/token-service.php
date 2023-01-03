<?php
require_once '../database/config.php';
require_once '../repositories/token-repository.php';

class TokenService {
    private $tokenRepository;

    public function __construct() {
        $this->tokenRepository = new TokenRepository();
    }

    public function createNewToken($email) {
        $token = bin2hex(random_bytes(8)); // random crypted symbols
        $expires = time() + 60; // * 60 * 24 * 1; // 1 day

        setcookie("token", $token, $expires, "/");

        $this->tokenRepository->addToken($token, $email, $expires);
    }
    
    public function isValidToken($token) {
        $foundToken = $this->tokenRepository->findToken($token);

        if ($foundToken) {
            if ($foundToken["expires"] <= time()) {
                throw new InvalidArgumentException("Session expired");
            }

            return $foundToken;
        }

        throw new InvalidArgumentException("Invalid token");
    }

}

?>