<?php

namespace backend\controllers;

use common\helpers\Helper;
/**
 * Class CourseTimeController 课程时间段设置 执行操作控制器
 * @package backend\controllers
 */
class CourseTimeController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\CourseTime';
     
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
