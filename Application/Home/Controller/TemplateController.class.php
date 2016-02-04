<?php
namespace Home\Controller;
use Think\Controller;
class TemplateController extends Controller {
	public function showTemplate(){
		$tpls = M('meeting_tpls')->select();
		$this->assign('tpls', $tpls);
		$this->display();
	}
}
