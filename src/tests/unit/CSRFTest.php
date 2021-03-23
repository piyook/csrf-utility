<?php

class CSRFTest extends \PHPUnit\Framework\TestCase
{

    protected $csrf;
    protected $expiryTime;

    protected function setUp():void {

        $this->expiryTime=100;
        $this->csrf = new \App\CSRF\CSRFController($this->expiryTime);
    }


    /** @test */
    public function check_1_returns_a_string_of_length_64(){

        $token = $this->csrf->generateToken();

        $this->assertIsString($token);
        $this->assertEquals(64,strlen($token));
    }

    /** @test */
    public function check_2_missing_CRSF_token_returns_false(){

        $storedToken="";
        $passedToken="";
       
        $this->assertFalse($this->csrf->validateToken($storedToken, $passedToken));
    }

    /** @test */
    public function check_3_invalid_CRSF_token_returns_false(){

        $storedToken=$this->csrf->generateToken();
        $passedToken="1234";
       
        $this->assertFalse($this->csrf->validateToken($storedToken, $passedToken));
    }

    /** @test */
    public function check_4_valid_CRSF_token_returns_true(){

        $token=$this->csrf->generateToken();
        
        $this->assertTrue($this->csrf->validateToken($token, $token));
    }

    
}

?>