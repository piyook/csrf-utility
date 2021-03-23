<?php

class CSRFControllerTest extends \PHPUnit\Framework\TestCase
{

    protected $csrf;
    protected $expiryTime;

    protected function setUp():void {

        $this->csrf = new \App\CSRF\CSRFController();
    }

    /** @test */
    public function check_1_CSRF_SESSION_cookie_is_set(){

        $token = $this->csrf->setHttpCSRFCookie();

        $this->assertTrue(isset($_SESSION['CSRF']));
    }

    /** @test */
    public function check_2_CSRF_http_cookie_is_set(){

        $this->assertTrue($this->csrf->setHttpCSRFCookie());
    }

    /** @test */
    public function check_3_if_http_cookie_is_not_set_return_false(){

        $this->assertFalse($this->csrf->checkHttpCSRFCookie());
    }

    /** @test */
    public function check_4_if_http_cookie_is_set_and_matches_session_cookie_return_true(){

        $_COOKIE['csrfToken']="1";
        $_SESSION['CSRF'] = "1";
        
        $this->assertTrue($this->csrf->checkHttpCSRFCookie());

    }

    /** @test */
    public function check_5_if_http_cookie_is_set_and_does_not_match_session_cookie_return_false(){

        $_COOKIE['csrfToken']="2";
        $_SESSION['CSRF'] = "1";
        
        $this->assertFalse($this->csrf->checkHttpCSRFCookie());

    }

    
}

?>