
<?php

//not my file, used from tutorial and modified
//https://www.w3jar.com/how-to-implement-the-jwt-with-php/


require './src/JWT.php';
require './src/ExpiredException.php';
require './src/SignatureInvalidException.php';
require './src/BeforeValidException.php';

use \Firebase\JWT\JWT;

class JwtHandler {
    protected $jwt_secrect;
    protected $token;
    protected $issuedAt;
    public $expire;
    protected $jwt;

    public function __construct()
    {
        // set your default time-zone
        date_default_timezone_set('Europe/Helsinki');
        $this->issuedAt = time();
        
        // Token Validity (3600 second = 1hr)
        $this->expire = $this->issuedAt + 60;//3600;

	//$this->expire = $this->issuedAt + 15;

        // Set your secret or signature
        $this->jwt_secrect = "this_is_my_secrect";  
    }

    // ENCODING THE TOKEN
    public function _jwt_encode_data($iss,$data){

        $this->token = array(
            //Adding the identifier to the token (who issue the token)
            "iss" => $iss,
            "aud" => $iss,
            // Adding the current timestamp to the token, for identifying that when the token was issued.
            "iat" => $this->issuedAt,
            // Token expiration
            "exp" => $this->expire,
            // Payload
            "data"=> $data
        );

        $this->jwt = JWT::encode($this->token, $this->jwt_secrect);
        return $this->jwt;

    }
    
  // ============== added this function to tutorial code ==============	
     public function _jwt_expiration_date($jwt_token) {

	try{
		$decode = JWT::decode($jwt_token, $this->jwt_secrect, array('HS256'));
		return  $decode->exp; //$jwt_token->exp;

	} catch(Exception $e){
		return "fail to open token";
	}


      }
   //==================================================================	


    //DECODING THE TOKEN
    public function _jwt_decode_data($jwt_token){
        try{
            $decode = JWT::decode($jwt_token, $this->jwt_secrect, array('HS256'));
            return $decode->data;
        }
        catch(\Firebase\JWT\ExpiredException $e){
            //return $e->getMessage();
	    return $decode->data;	
        }
        catch(\Firebase\JWT\SignatureInvalidException $e){
            return $e->getMessage();
	    return $decode->data;	
        }
        catch(\Firebase\JWT\BeforeValidException $e){
            return $e->getMessage();
        }
        catch(\DomainException $e){
            return $e->getMessage();
        }
        catch(\InvalidArgumentException $e){
            return $e->getMessage();
        }
        catch(\UnexpectedValueException $e){
            return $e->getMessage();
        }

    }
}
