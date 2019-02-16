<?php

namespace backend\controllers;


use backend\models\IntroductionType;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use common\helpers\Helper;

/**
 * Class IntroductionController 校园风采 执行操作控制器
 * @package backend\controllers
 */
class IntroductionController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\Introduction';
     
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
     * 显示视图
     * @return string
     */
    public function actionIndex()
    {
        // 查询出全部属性
        $arrIntroduction = IntroductionType::findIntroductionTypes([]);

        // 载入视图 
        return $this->render('index', [
            'introduction' => Json::encode(ArrayHelper::map($arrIntroduction,'id','name')),
        ]);
    }
	
}
