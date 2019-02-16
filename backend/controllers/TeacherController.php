<?php

namespace backend\controllers;

use backend\models\Grade;
use backend\models\Card;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use common\helpers\Helper;

/**
 * Class TeacherController 教师管理 执行操作控制器
 * @package backend\controllers
 */
class TeacherController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\Teacher';
     
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
            'phone' => 'like', 
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
        $arrGrades = Grade::findGrades('sid=410004001 and pid != 0');
        $arrCards = Card::findCards('sid=410004001');
        // 载入视图
        return $this->render('index', [
            'grades' => Json::encode(ArrayHelper::map($arrGrades,'cid','name')),
            'cards' => Json::encode(ArrayHelper::map($arrCards,'id','card','status')),
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
}
