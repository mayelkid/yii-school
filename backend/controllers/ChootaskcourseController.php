<?php

namespace backend\controllers;

use backend\models\Choosetasks;
use backend\models\TeacherCourse;
use backend\models\Student;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use common\helpers\Helper;

/**
 * Class ChootaskcourseController 学生选课调查记录表 执行操作控制器
 * @package backend\controllers
 */
class ChootaskcourseController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\Chootaskcourse';
     
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
        $arrTasks = Choosetasks::findChoosetaskid('sid=410004001');
        $arrCourses = TeacherCourse::findCourses('sid=410004001');
        $arrStudents = Student::findStudents('sid=410004001');
		foreach($arrCourses as &$v){
			$v['combine']=$v['course_name'].'-'.$v['teacher_name'];
		}
       
        return $this->render('index', [ 
            'tasks' => Json::encode(ArrayHelper::map($arrTasks,'id','name')),
            'courses' => Json::encode(ArrayHelper::map($arrCourses,'course_id','combine')),
            'students' => Json::encode(ArrayHelper::map($arrStudents,'student_id','name')),
        ]);
    }
}
