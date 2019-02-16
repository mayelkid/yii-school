<?php

namespace backend\controllers;

/**
 * Class AttendanceTypeController 考勤类型 执行操作控制器
 * @package backend\controllers
 */
class AttendanceTypeController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\AttendanceType';
     
    /**
     * 查询处理
     * @param  array $params
     * @return array 返回数组
     */
    public function where($params)
    {
        return [
            
        ];
    }
}
