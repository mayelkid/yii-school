<?php

namespace backend\controllers;

use backend\models\Choosetasks;
use backend\models\Choosetaskgroups;
use backend\models\Student;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii;
use common\helpers\Helper;

/**
 * Class ChootaskstudentsController 学生选课表 执行操作控制器
 * @package backend\controllers
 */
class ChootaskstudentsController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\Chootaskstudents';
     
    /**
     * 查询处理
     * @param  array $params
     * @return array 返回数组
     */
    public function where($params)
    {
        $where=[['and',['is_deleted'=>0]]];
		$bbs = Helper::getIdentity();
		if(!empty($bbs['sid'])){
			$where[0][] = ['sid'=>$bbs['sid']];
		}
        return [
            'choosetaskgroupid' => '=',
            'where' => $where,
        ];
    }
	
	/**
     * 显示视图
     * @return string
     */
    public function actionIndex() 
    {
		$data = Yii::$app->request->get('id','');
        $arrTasks = Choosetasks::findChoosetaskid('sid=410004001');
        $arrGroupstudents = Choosetaskgroups::findGroupstudents('sid=410004001');
        $arrStudents = Student::findStudents('sid=410004001');
       
        return $this->render('index', [ 
            'tasks' => Json::encode(ArrayHelper::map($arrTasks,'id','name')),
            'groupname' => Json::encode(ArrayHelper::map($arrGroupstudents,'id','coursegroupname')),
            'students' => Json::encode(ArrayHelper::map($arrStudents,'student_id','name')),
			'id'=>$data,
        ]);
    }
}
