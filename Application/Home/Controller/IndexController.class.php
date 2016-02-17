<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	var $global_str;
	public function _initialize(){
		$this->global_str = 'global_str_SLDKFJSLDKJFOSDMFLSK';
	}
    public function index(){
        $md5value = md5('123456'.'salt');
        $this->assign('md5value', $md5value);
        $this->display('md5Index');
    }
    public function index_trans(){
        $line_items = array("0"=>"line 1", "1"=>"line 2", "2"=>"line 3");
        if(IS_POST){
            $transDB = new \Think\Model();
            $transDB->startTrans();
            $title = array('title'=>$_POST['title']);
            $header_result = $transDB->table('t_header')->add($title);

            if($header_result){
                $id = $transDB->table('t_header')->getLastInsID();
                $line = array('line'=>$_POST['selectedText'], 'header_id'=>$id);
                $line_result = $transDB->table('t_detail')->add($line);
                if($line_result){
                    $transDB->commit();
                } else {
                    $transDB->rollback();
                }
            }
            else {
                $transDB->rollback();
            }
        }
        $this->assign('line_items', $line_items);
        $this->display('transDemo');
    }
	public function index_iwe(){
		$cName = 'Home\Common\Lottery\LotteryRuleFactory';
		if(class_exists($cName)){
			$obj = new $cName();
			$mName = 'getDemoText';
			$this->assign('str', $obj->$mName());
		} else {
			$this->assign('str', 'Class not exists!');
		}

		$cName_helper = 'Home\Common\Lottery\\'.'Helper';
		if(class_exists($cName_helper)){
			$obj_helper = new $cName_helper();
			$mName_helper = 'getDemoText';
			$this->assign('str_helper', $obj_helper->$mName_helper());
		} else {
			$this->assign('str_helper', 'Class not exists!');
		}

		//$another = new \Home\Common\Lottery\Helper(' Test INPUT ');
		$another = new \Home\Common\Lottery\Helper();
		$this->assign('another_str', $another->getDemoText());
		$this->assign('global_str', $this->global_str);

		$meeting_id='1431';
		$lotteryRules_by_meetingId = M('lottery_rules')->where('meetingID='.$meeting_id)->select();
		$currentMeeting = M('meetings')->find($meeting_id);
		$lotteryRules_by_templateId = M('lottery_rules')->where('meetingTplID='.$currentMeeting['Tplid'])->select();

		$test_str = ',0,1,2,3,';
		$this->assign('test_str', trim($test_str, ','));


		/*
		$survey_list = M('meeting_survey')->where('meetingid=1431')->select();
		$survey_question_map = array();

		foreach($survey_list as $key=>$survey){
			$questionids = explode(',', trim($survey['questionids'], ','));
			$map['id'] = array('in', $questionids, 'AND');
			$map['hasanswer'] = array('eq', 2, 'AND');
			$questions = M('survey_questions')->where($map)->select();
			$survey_question_map[$survey['id']] = $questions;
		}

		$answer_openids = M('survey_answers')->field('openid')->distinct(true)->where('meetingid=1431')->select();
		$this->assign('openids', $answer_openids);
		 */
		//unset($map);
		$questionids = '1601, 1602, 1603, 1604';
		//$map['td_survey_questions.id'] = array('in', $questionids);
		/*
		$question_answers = new \Think\Model();
		$question_answers->query('select q.id, questionid, q.selections, q.answer correctAnswer, a.openid, a.answer
									from td_survey_questions q left join td_survey_answers a
									on q.id = a.questionid 
									where q.id in ('.$questionids.')');
		 */
		$question_answers_model = new \Think\Model();
		$question_answer = $question_answers_model->query('select q.id, questionid, q.selections, q.answer correctAnswer, a.openid, a.answer
									from td_survey_questions q left join td_survey_answers a
									on q.id = a.questionid 
									where q.id in ('.$questionids.') order by a.openid');
			
			/*
		$question_answers = M('survey_questions')->join('left join td_survey_answers survey_answers on td_survey_questions.id=survey_answers.questionid')
								->field('td_survey_questions.id questionid, td_survey_questions.selections, td_survey_questions.answer correctAnswer, survey_answers.openid, survey_answers.answer')
								->where($map);
			 */
		echo $question_answers_model->getLastSql();

        $list = array('Shingen', 'Kenshin', 'Ieyasu', 'Nobunaga');
        $this->assign('list', $list);


		$this->display();
	}
	public function showTemplate(){
		$content = '跪け、許しを問う姿を見せてくれ。';
		$this->assign('content', $content);
		$tpl_name = 'test';
		$this->display('./Public/bundle/'.$tpl_name.'/first.html');
	}
    public function connect(){//~/index.php/Home/index/index
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
		//echo 'hello'.C('ANOTHER').'!';
		$version = M('version')->select()[0];
		$this->assign('version', $version);

		$msHost = C('MSDB.DB_HOST');
		$msUser = C('MSDB.DB_USER');
		$msPwd = C('MSDB.DB_PWD');
		$msConnect = mssql_connect($msHost, $msUser, $msPwd);
		if($msConnect) {
			mssql_select_db(C('MSDB.DB_NAME'), $msConnect);
			$vTextRows = mssql_query("select vText from t_version");
			$vText = mssql_fetch_assoc($vTextRows)['vText'];
			$this->assign('vText', $vText);
			mssql_close($msConnect);
		} else {
			$this->assign('vText', 'Connection failed.');
		}

		$this->display();
    }

	/*
	public function hospital(){
		$hospital = M('hospital');
		$h = $hospital->where('code=100010')->select()[0];
		$this->assign('h', $h);
		$this->display();
	}
	public function hello($name='thinkPHP'){
		//echo 'hello,'.$name.'!';//~/index.php/Home/index/hello?name={name}
		$this->assign('name', $name);
		$this->display();
	}
	public function showAnother(){
		//when upper case exists in table name, use M function in this way
		$person = M()->table("Busyou");
		$p = $person->find(0);
		$this->assign('p',$p);
		$this->display();
	}
	public function showPerson(){
		$person = M('person','t_','DB_AZURE_CONN_STR');
		$p = $person->find('64ca91dc-94db-11e5-847e-080027cecbdb');
		//$p = $person->find('57e59fae-9351-11e5-90c0-080027cecbdb');
		//$p = $person->where('1=1')->select()[0];
		$this->assign('p', $p);

		$doubleLow0 = C('DOUBLE.LOW0');
		$this->assign('doubleLow0', $doubleLow0);
		$this->display();
	}
	 */
}
