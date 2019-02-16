<?php

namespace backend\controllers;

use backend\models\Grade;
use backend\models\Teacher;
use backend\models\Classroom;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii;
use common\helpers\Helper;

/**
 * Class GradeController 年级管理 执行操作控制器
 * @package backend\controllers
 */
class GradeController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\Grade';
     
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
        $arrTeachers = Teacher::findTeachers(['sid'=>'410004001']);
        $arrClassrooms = Classroom::findClassroom(['sid'=>'410004001']);
		
        // 载入视图
        return $this->render('index', [
            'grades' => Json::encode(ArrayHelper::map($arrGrades,'cid','name')),
            'teachers' => Json::encode(ArrayHelper::map($arrTeachers,'teacher_id','name')),
            'classrooms' => Json::encode(ArrayHelper::map($arrClassrooms,'classroom_id','classroom')),
        ]);
    }
	/**
     * 升班
     */
	public function actionPromotion()
    {
		$request = Yii::$app->request;
        $get = $request->get();  
		print_r($get);exit;
		return $this->render('promotion');
    }
}
