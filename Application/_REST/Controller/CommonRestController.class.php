<?php
namespace _REST\Controller;
use Think\Controller\RestController;
Vendor('php-jwt.BeforeValidException');
Vendor('php-jwt.ExpiredException');
Vendor('php-jwt.SignatureInvalidException');
Vendor('php-jwt.JWT');
use \Firebase\JWT\JWT;
class CommonRestController extends RestController{
    protected $allowMethod = array('get', 'put', 'post');
    protected $allowType = array('json');
    protected $allowOutputType = array('json'=>'application/json');
    protected $noAuthResult = array('code'=>'401', 'message'=>'Not Authorized', 'data'=>array());
    protected $unknownResult = array('code'=>'500', 'message'=>'Unknown Internal Error', 'data'=>array());
    protected $encryKey = "demo_website";

    public function _initialize(){
        define('OK', 200);
        define('Unauthorized', 401);
        define('Forbidden', 403);
        define('Unknown', 500);
    }

    protected function getAuthorization(){
        $authorization = apache_request_headers();
        if($authorization){
            return $authorization;
        }

        //if current web server is not apache,
        //then try another way
        //this way needs .htaccess file enabled
        $authorization = var_dump($_SERVER['Authorization']);

        return $authorization;
    }

    protected function checkJWTAuth($authorization){
        if(!$authorization) return constant('Unauthorized');

        //$tokenId  = base64_encode(mcrypt_create_iv(32));
        /*
        $base_token = array(
            "iss" => "http://nnweb1.chinacloudsites.cn/",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000
        );

        $jwt = JWT::encode($base_token, $encryKey);
         */

        try{
            $decoded = JWT::decode($authorization, $this->encryKey, array('HS256'));

            $token = (array)$decoded;
        } catch(\UnexpectedValueException $ex){
            return constant('Forbidden');
        }
        return constant('Unknown');
    }

    public function login(){
        if($this->_method == 'post'){
            $username = I('post.username');
            $hasedPassword = I('post.password');
        }
    }
}
