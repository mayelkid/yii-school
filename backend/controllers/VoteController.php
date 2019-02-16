<?php

namespace backend\controllers;

use common\helpers\Helper;
/**
 * Class VoteController 投票信息 执行操作控制器
 * @package backend\controllers
 */
class VoteController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\Vote';
     
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
     * 投票结果列表
     * @return string
     */
	public function actionSee()
    {
		return $this->redirect(['see']);
    }
}
		