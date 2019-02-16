<?php

namespace backend\controllers;

use common\helpers\Helper;
/**
 * Class ProfileTypeController 档案属性 执行操作控制器
 * @package backend\controllers
 */
class ProfileTypeController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\ProfileType';
     
    /**
     * 查询处理
     * @param  array $params
     * @return array 返回数组
     */
    public function where($params)
    {
        $where=[['and']];
		$bbs = Helper::getIdentity();
		if(!empty($bbs['sid'])){
			$where[0][] = ['sid'=>$bbs['sid']];
		}
        return [
			'type_id'=>'=', 
            'where' => $where,
        ];
    }
}
