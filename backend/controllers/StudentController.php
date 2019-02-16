<?php

namespace backend\controllers;

use backend\models\Grade;
use backend\models\Student;
use backend\models\Card;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use common\helpers\Excel;
use common\helpers\Helper;
use yii;
/**
 * Class StudentController 学生管理 执行操作控制器
 * @package backend\controllers
 */
class StudentController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\Student';
     
    /**
     * 查询处理
     * @param  array $params
     * @return array 返回数组
     */
    public function where($params)
    {
		$where=[['and',['is_deleted'=>0]]];
		//print_r($where);exit;
		$bbs = Helper::getIdentity();
		//print_r($bbs);
		if(!empty($bbs['sid'])){
			$where[0][] = ['sid'=>$bbs['sid']];
		}
		if(!empty($bbs['grade'])){
			$where[0][] = ['grade'=>$bbs['grade']];
		}
		//print_r($where);exit;
		//print_r(array_merge($where,));exit;
		
		//;
        return [
            'student_id' => '=', 
			'card_id' => '=', 
			'grade' => '=', 
			'name' => 'like', 
			'where' => $where,

        ];
    }
	
	/**
     * 显示视图
     * @return string
     */
    public function actionIndex()
    {
        // 查询出全部角色
		$session = Yii::$app->session;
		$session = $session->get('user');
		//print_r($session);exit;
        $arrGrades = Grade::findGrades('sid=410004001 and pid != 0');
        $arrCards = Card::findCards('sid=410004001');
       
		//print_r($arrCardTwos);exit;
        // 载入视图
        return $this->render('index', [
            'grades' => Json::encode(ArrayHelper::map($arrGrades,'cid','name')),
            'cards' => Json::encode(ArrayHelper::map($arrCards,'id','card','status')),
        ]);
    }
	
	/**
     * 升班
     */
	public function actionPromotion()
    {
		$request = Yii::$app->request;
        $get = $request->get();
		$post = $request->post();
		if(!empty($get['promotion'])){
			 exit('a');
		}
		 
		$arrGrades = Grade::findGrades('sid=410004001 and pid != 0');
		return $this->render('promotion',[
			'grade'=>$get['grade'],
			'arrRoles'=>ArrayHelper::map($arrGrades,'cid','name'),
		]);
    }
	/**
     * 查询之后的数据处理函数 
     * @access protected
     * @param  mixed $array 查询出来的数组对象
     * @return void  对数据进行处理
     * @see actionSearch()
     */
    protected function afterSearch(&$array)
    {
		
    }
	
	
	/**
     * [Import excel导入页面]
     */
	public function import()
	{
		$request = Yii::$app->request;
		if($request->isPost() && $post=$request->post()){
			$excel = new Excel(['title'=>Student::getStudentExcel(), 'msg'=>'导出']);
			$data = $excel->Import($post['file']);
			if(empty($data)) return $this->error(205);
			$this->import_filter($data);
			$student=new Student();
			foreach($data as $redata){
				if(false === $student->save($redata)){
					return $this->error(1001);
				}
			}
			return $this->success('',"数据插入".count($data)."成功！");
		}
		return $this->render('import'); 
	}
	/**
	 * [import_filter excel导入数据处理]
	 */
	private function import_filter(&$data)
	{
		$arr=Student::find()->where(['sid'=>'410004001'])->column('student_id');
		foreach($data as $k => $v){
			if(empty($v['name'])||false===in_array($v['student_id'],$arr)){
				unset($data[$k]);
			}else{
				$data[$k]['sid']='410004001';
				$data[$k]['sex']=($v['sex']==='男') ? 0 : 1;
				
			}
		}
		
	}
}
