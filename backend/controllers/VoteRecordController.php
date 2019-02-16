<?php

namespace backend\controllers;

use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use backend\models\Vote;
use backend\models\VoteOption;
use backend\models\Student;
use common\helpers\Helper;
/**
 * Class VoteRecordController 确认结果 执行操作控制器
 * @package backend\controllers
 */
class VoteRecordController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\VoteRecord';
     
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
     * 列表显示
     * @return string
     */
	public function actionIndex()
    {
		$arrVote = Vote::findVote(['sid'=>'410004001']);
		$arrOption = VoteOption::findOption(['sid'=>'410004001']);
		$students = Student::findStudents(['sid'=>'410004001']);
        return $this->render('index',[
			'vote' => Json::encode(ArrayHelper::map($arrVote,'id','title')),
			'option' => Json::encode(ArrayHelper::map($arrOption,'id','option')),
			'students' => Json::encode(ArrayHelper::map($students,'id','name')),
		]);
        
	
    }
}
