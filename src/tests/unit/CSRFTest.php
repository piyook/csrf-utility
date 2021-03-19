<?php

class CSRFTest extends \PHPUnit\Framework\TestCase
{

    protected $csrf;

    protected function setUp():void {
        $this->csrf = new \App\CSRF\CSRF;
    }

    /** @test */
    public function check_1_CSRF_expiration_set_and_is_a_integer(){

            $this->assertIsInt(CSRF_EXPIRE);

    }

    /** @test */
    public function check_2_returns_a_string_of_length_64(){

        $token = $this->csrf->generateToken();

        $this->assertIsString($token);
        $this->assertEquals(64,strlen($token));
    }

    /** @test */
    public function check_3_missing_CRSF_token_returns_false(){

        $storedToken="";
        $passedToken="";
       
        $this->assertFalse($this->csrf->validateToken($storedToken, $passedToken));
    }

    /** @test */
    public function check_4_invalid_CRSF_token_returns_false(){

        $storedToken=$this->csrf->generateToken();
        $passedToken="1234";
       
        $this->assertFalse($this->csrf->validateToken($storedToken, $passedToken));
    }

    /** @test */
    public function check_5_valid_CRSF_token_returns_true(){

        $token=$this->csrf->generateToken();
        
        $this->assertTrue($this->csrf->validateToken($token, $token));
    }

    
    /** @test */
    public function check_6_valid_time_for_CSRF_token_returns_true(){

        $token_grant_time = time();
        $this->assertTrue($this->csrf->checkTokenExpiration($token_grant_time, CSRF_EXPIRE));
    }

    /** @test */
    public function check_7_invalid_time_for_CSRF_token_returns_false(){

        $failing_token_grant_time = time() - CSRF_EXPIRE - 1;
        $this->assertFalse(
            $this->csrf->checkTokenExpiration($failing_token_grant_time, CSRF_EXPIRE)
        );
    }
}

?>