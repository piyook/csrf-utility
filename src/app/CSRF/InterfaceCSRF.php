<?php

namespace App\CSRF;

interface InterfaceCSRF {

    public function setHttpCSRFCookie():bool;

    public function checkHttpCSRFCookie():bool;
}
?>