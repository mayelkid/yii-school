<?php

namespace backend\controllers;


use common\models\China;
use yii\helpers\ArrayHelper;
use common\helpers\Helper;
/**
 * Class NoticeController 学校 执行操作控制器
 * @package backend\controllers
 */
class SchoolController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\School';
     
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
			'name'=>'like',
            'where' => $where,
        ];
    }
	 /**
     * 首页显示
     * @return string
     */
    public function actionIndex()
    {
        $china = China::find()->where(['pid' => 0])->asArray()->all();

        // 加载视图
        return $this->render('index', [
            'parent' => ArrayHelper::map($china, 'id', 'name'),
        ]);
    }
}
