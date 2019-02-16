<?php

namespace backend\controllers;

use backend\models\Grade;
use backend\models\Subject;
use backend\models\Teacher;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * Class TeacherCourseController 教师授课表 执行操作控制器
 * @package backend\controllers
 */
class TeacherCourseController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\TeacherCourse';
     
    /**
     * 查询处理
     * @param  array $params
     * @return array 返回数组
     */
    public function where($params)
    {
        $where=[['and',['sid'=>410004001],['is_deleted'=>0]]];
        return [
           'where' => $where,
        ];
    }
	
	public function actionIndex()
    {
        // 查询出全部角色
        
        $arrSubjects = Subject::findSubjects(['sid'=>'410004001']);
        $arrTeachers = Teacher::findTeachers(['sid'=>'410004001']);

        // 载入视图
        return $this->render('index', [ 
            'subjects' => Json::encode(ArrayHelper::map($arrSubjects,'subject_id','subject_name')),
            'teachers' => Json::encode(ArrayHelper::map($arrTeachers,'teacher_id','name')),
        ]);
    }
}
