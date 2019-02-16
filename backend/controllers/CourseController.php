<?php

namespace backend\controllers;

use backend\models\Grade;
use backend\models\TeacherCourse;
use backend\models\CourseTime;
use backend\models\Teacher;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use common\helpers\Helper;
/**
 * Class CourseController 课程表 执行操作控制器
 * @package backend\controllers
 */
class CourseController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\Course';
     
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
            'grade' => '=', 
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
        $arrGrades = Grade::findGrades('sid=410004001 and pid != 0');
        $arrCourses = TeacherCourse::findCourses(['sid'=>'410004001']);
        $arrCourseLesson = CourseTime::findCourseTime(['sid'=>'410004001']);
		$arrTeacher = Teacher::findTeachers(['sid'=>'410004001']);
		foreach($arrCourses as &$v){
			$tid = array_search($v['teacher_id'],$arrTeacher);
			if(!empty($tid)){
				$v['tname'] = $arrTeacher[$tid]['name'];
			}
		}
		//print_r($arrCourses);exit;
        // 载入视图
        return $this->render('index', [
            'grades' => Json::encode(ArrayHelper::map($arrGrades,'cid','name')),
            'courses' => Json::encode(ArrayHelper::index($arrCourses,'course_id')),
            'lessons' => Json::encode(ArrayHelper::map($arrCourseLesson,'lesson','name')),
			
        ]);
    }
	
}
