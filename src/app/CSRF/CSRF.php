<?php

namespace App\CSRF;

class CSRF {
    
    /**
     * returns a CSRF token of 32 random bytes as hexadecimal (64 characters)
     *
     * @return string
     */
    public function generateToken():string {

        return bin2hex(random_bytes(32));

    }
    
    /**
     * validates CSRF token with timing safe string comparision
     *
     * @param  string $storedToken
     * @param  string $passedToken
     * @return bool
     */
    public function validateToken($storedToken, $passedToken){

        if ($passedToken==="" || $storedToken===""){return false;}

        if (hash_equals($storedToken, $passedToken)){return true;};

        return false;
    }
    
    /**
     * checks token is within its allowed use time period
     *
     * @param  int $token_grant_time
     * @param  int $expiration_period
     * @return bool
     */
    public function checkTokenExpiration($token_grant_time, $expiration_period){

        $time_since_grant = time() - $token_grant_time;

        if ($time_since_grant < $expiration_period) {
            return true;
        }

        return false;

    }

}

?>