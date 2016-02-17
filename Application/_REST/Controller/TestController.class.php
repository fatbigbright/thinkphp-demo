<?php
namespace _REST\Controller;
use Think\Controller\RestController;

class TestController extends CommonRestController{
    public function getFoo(){
        if($this->_method == 'get'){
            $authorization = $this->getAuthorization();
            $jwtCheckResult = $this->checkJWTAuth($authorization);

            switch($jwtCheckResult){
            case constant('Unauthorized'):
                return $this->response($this->noAuthResult, 'json');
            default:
                return $this->response($this->unknownResult, 'json');
            }
            return $this->response(array('code'=>'0', 'message'=>'Success', 'data'=>array('just', 'foo')), 'json');
        }
    }
}
