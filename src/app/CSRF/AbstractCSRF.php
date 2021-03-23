<?php

namespace App\CSRF;

class AbstractCSRF
{

    /**
     * returns a CSRF token of 32 random bytes as hexadecimal (64 characters)
     *
     * @return string
     */
    public function generateToken(): string
    {

        return bin2hex(random_bytes(32));
    }

    /**
     * validates CSRF token with timing safe string comparision
     *
     * @param  string $storedToken
     * @param  string $passedToken
     * @return bool
     */
    public function validateToken($storedToken, $passedToken)
    {

        if ($passedToken === "" || $storedToken === "") {
            return false;
        }

        if (hash_equals($storedToken, $passedToken)) {
            return true;
        };

        return false;
    }
}
