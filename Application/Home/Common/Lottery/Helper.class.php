<?php
namespace Home\Common\Lottery;
class Helper{
	var $input;
	var $input1;
	public function _initialize(){
		$this->input = ' INPUTINPUT ';
		$this->input1 = ' AAAAA from INITIALIZE ';
	}
	public function getDemoText(){
		return 'This is Demo Text of Home\Common\Lottery\Helper. '.$this->input.$this->input1;
	}
}
?>
