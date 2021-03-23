<?php

//get request to this endpoint sends back a set-cookie header for a cookie containing the CSRF token

require('../app/bootstrap.php');
$csrf = new \App\CSRF\CSRFController();

$csrf->setHttpCSRFCookie();
header('HTTP/1.0 200 OK');
          
?>


