<?php

namespace backend\controllers;

use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use backend\models\Vote;
use Yii;
use common\helpers\Helper;
/**
 * Class VoteOptionController 选项内容 执行操作控制器
 * @package backend\controllers
 */
class VoteOptionController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\VoteOption';
     
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
        $where = [
            'vote_id' => '=',
            'option' => 'like',
            'where' => $where,
        ];
        return $where;
    } 

	/**
     * 列表显示
     * @return string
     */
	public function actionIndex()
    {
		$arrVote = Vote::findVote(['sid'=>'410004001']);
		
		$data = Yii::$app->request->get('id','');
        return $this->render('index', ['id'=>$data,'vote' => Json::encode(ArrayHelper::map($arrVote,'id','title'))]);
        
	
    }
}
