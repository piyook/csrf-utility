<?php

namespace App\CSRF;

/**
 * Exception for handling CSRF errors setting Session Cookie
 */
class CSRFException extends \Exception
{
    public function errorMessage() {
        //error message
        $errorMsg = 'ERROR: Session Cookie could not be set';
        return $errorMsg;
      }
}



?>