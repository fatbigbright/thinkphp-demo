<?php
namespace Home\Controller;
use Think\Controller\RestController;
class DemoRestController extends RestController {
	protected $allowMethod = array('get', 'post', 'put');
	protected $allowType = array('json');
	protected $allowOutputType = array('json'=>'application/json');

	public function test(){
		if($this->_method == 'get'){
			$data = array('data'=>array('id'=>'1', 'name'=>'test'), 'code'=>'0', 'message'=>'OK');
			$this->response($data, 'json');
		}
	}
}
