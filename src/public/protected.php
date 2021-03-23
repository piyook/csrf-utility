<?php

//this is a demo CSRF protected resource which could be a form submission endpoint

require('../app/bootstrap.php');
$csrf = new \App\CSRF\CSRFController();
$csrf->checkHttpCSRFCookie();


?>