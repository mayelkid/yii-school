<?php

namespace backend\controllers;

use backend\models\AttendanceType;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
/**
 * Class AttendanceController 考勤记录 执行操作控制器
 * @package backend\controllers
 */
class AttendanceController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\Attendance';
     
    /**
     * 查询处理
     * @param  array $params
     * @return array 返回数组
     */
    public function where($params)
    {
		$where=[['and',['sid'=>410004001],['is_deleted'=>0]]];
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
        $attendanceTypes = AttendanceType::findAttendanceTypes([]);

        // 载入视图
        return $this->render('index', [
            'attendanceTypes' => Json::encode(ArrayHelper::map($attendanceTypes,'type_id','type_name')),
        ]);
    }
}
