<?php

namespace App\CSRF;

class CSRFController extends AbstractCSRF implements InterfaceCSRF
{

    /**
     * calls sets CSRF cookie and Session variable
     *
     * @return bool
     */
    public function setHttpCSRFCookie(): bool
    {

        $_SESSION['CSRF'] = $this->generateToken();

        if (!isset($_SESSION['CSRF'])){
            throw new CSRFException;
        }

        return setcookie('csrfToken', $_SESSION['CSRF'], [
            'expires' => time() + 3600,
            'path' => '/',
            'domain' => false,
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict',
        ]);

        
    }

    /**
     * checks that CSRF cookie sent by browser and the Session Cookie match
     *
     * @return bool
     */
    public function checkHttpCSRFCookie(): bool
    {

        if (!isset($_COOKIE['csrfToken']) || !isset($_SESSION['CSRF'])) {
            header('HTTP/1.0 403 Forbidden');
            return FALSE;
        }


        if ($this->validateToken($_SESSION['CSRF'], $_COOKIE['csrfToken'])) {
            header('HTTP/1.0 200 OK');
            return TRUE;
        } else {
            header('HTTP/1.0 403 Forbidden');
            return FALSE;
        }
    }
}
