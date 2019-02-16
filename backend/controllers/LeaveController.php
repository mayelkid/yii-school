<?php

namespace backend\controllers;

use common\helpers\Helper;
/**
 * Class LeaveController 请假信息 执行操作控制器
 * @package backend\controllers
 */
class LeaveController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\Leave';
     
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
}
