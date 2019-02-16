<?php

namespace backend\controllers;
use backend\models\Grade;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use backend\models\TeacherCourse;
use common\helpers\Helper;

/**
 * Class ChoosetasksController 选课任务 执行操作控制器
 * @package backend\controllers
 */
class ChoosetasksController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\Choosetasks';
     
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
        $arrGrades = Grade::findGrades(['sid'=>'410004001','pid'=>'0']);
		$arrCourses = TeacherCourse::findCourses(['sid'=>'410004001']);
		
        // 载入视图
        return $this->render('index', [
            'grades' => Json::encode(ArrayHelper::map($arrGrades,'cid','name')),
			'courses' => Json::encode(ArrayHelper::map($arrCourses,'course_id','course_name')),

        ]);
    }
	 
}
