<?php

namespace backend\controllers;

use backend\models\Student;
use backend\models\ProfileType;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use common\helpers\Helper;

/**
 * Class ProfileController 学生档案 执行操作控制器
 * @package backend\controllers
 */
class ProfileController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\Profile';
     
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
			'type_id'=>'=', 
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
        $arrProfileTypes = ProfileType::findProfileTypes(['or',['sid'=>410004001],['sid'=>0]]);
        $arrStudents = Student::findStudents(['sid'=>'410004001']);

        // 载入视图 
        return $this->render('index', [
            'arrStudents' => Json::encode(ArrayHelper::map($arrStudents,'student_id','name')),
            'profileTypes' => Json::encode(ArrayHelper::map($arrProfileTypes,'id','title')),
        ]);
    }
}
