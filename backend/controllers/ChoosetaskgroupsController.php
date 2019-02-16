<?php

namespace backend\controllers;

use backend\models\Choosetasks;
use backend\models\TeacherCourse;
use common\helpers\Helper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii;

/**
 * Class ChoosetaskgroupsController 选课套餐表 执行操作控制器
 * @package backend\controllers
 */
class ChoosetaskgroupsController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\Choosetaskgroups';
     
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
            'choosetaskid' => '=',
            'where' => $where,
        ];
    }
	/**
     * 显示视图
     * @return string
     */
    public function actionIndex()  
    {
		$data = Yii::$app->request->get('id','');
        $arrTasks = Choosetasks::findChoosetaskid('sid=410004001');
		$arrCourses = TeacherCourse::findCourses(['sid'=>'410004001']);
		foreach($arrCourses as &$v){
			$v['combine']=$v['course_name'].'-'.$v['teacher_name'];
		}
       
        return $this->render('index', [
            'tasks' => Json::encode(ArrayHelper::map($arrTasks,'id','name')),
			'courses' => Json::encode(ArrayHelper::map($arrCourses,'course_id','combine')),
			'id'=>$data,
        ]);
    }
	
	  /**
     * 处理新增数据
     *
     * @return mixed|string
     */
    public function actionCreate()
    {
        $data = Yii::$app->request->post();
		file_put_contents('1.txt',json_encode($data));
        if (!is_array($data['coursegroupids'])) {
            return $this->error(201);
        }
		foreach ($data['coursegroupids'] as $item_id){
			$course = TeacherCourse::findone(['course_id'=>$item_id]);
			$groups .= $course['course_name'].',';
		}
		$data['coursegroupname']=rtrim($groups,',');
		$data['coursegroupids']=implode(',',$data['coursegroupids']);

		$model = new $this->modelClass();

        // 验证是否定义了创建对象的验证场景
        $arrScenarios = $model->scenarios();
        if (isset($arrScenarios['create'])) {
            $model->scenario = 'create';
        }

        // 对model对象各个字段进行赋值
        $this->arrJson['errCode'] = 205;
        if (!$model->load($data, '')) {
            return $this->error(205);
        }
		 // 判断修改返回数据
        if ($model->save()) {
            $this->handleJson($model);
            $pk = $this->pk;
            return $this->success($model);
        } else {
            return $this->error(1001, Helper::arrayToString($model->getErrors()));
        }
    }
	
	/**
     * 处理修改数据
     * @return mixed|string
     */
    public function actionUpdate()
    {
        // 接收参数判断
        $data = Yii::$app->request->post();
		if (!is_array($data['coursegroupids'])) {
            return $this->error(201);
        }
		foreach ($data['coursegroupids'] as $item_id){
			$course = TeacherCourse::findone(['course_id'=>$item_id]);
			$groups .= $course['course_name'].',';
		}
		$data['coursegroupname']=rtrim($groups,',');
		$data['coursegroupids']=implode(',',$data['coursegroupids']);

        $model = $this->findOne();
        if (!$model) {
            return $this->returnJson();
        }

        // 判断是否存在指定的验证场景，有则使用，没有默认
        $arrScenarios = $model->scenarios();
        if (isset($arrScenarios['update'])) {
            $model->scenario = 'update';
        }

        // 对model对象各个字段进行赋值
        if (!$model->load($data, '')) {
            return $this->error(205);
        }

        // 修改数据成功
        if ($model->save()) {
           // AdminLog::create(AdminLog::TYPE_UPDATE, $data, $this->pk . '=' . $data[$this->pk]);
            return $this->success($model);
        } else {
            return $this->error(1003, Helper::arrayToString($model->getErrors()));
        }
    }
}
