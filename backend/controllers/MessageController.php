<?php

namespace backend\controllers;

use common\helpers\Helper;
/**
 * Class MessageController 家长留言 执行操作控制器
 * @package backend\controllers
 */
class MessageController extends Controller
{
    /**
     * @var string 定义使用的model
     */
    public $modelClass = 'backend\models\Message';
     
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
            'pubname' => 'like', 
			'pubtel' => 'like', 
			'sid' => '410004001',
			'is_deleted' => 0,
			'where' => $where,

        ];
    }
	
	/**
	 *	获取家长留言
     * @param integer|array $where 查询条件
     * @return array
     */
    public static function findVote($where)
    {		
		$where['is_deleted'] = 0;
		if(isset($where['key']) && $where['key'] !== ''){
			$key = $where['key'];unset($where['key']);
		}
		$db = static::find()->where($where)->asArray()->indexBy('id');
		if(isset($key) && $key !== ''){
			$db->andwhere(['like', 'title', $key]);
		}
		$parents = $db->all();
        return $parents; 
    } 			
	
	/*
     * 删除家长留言
     * @return array
    */ 
    public static function delVote($data)
    {
        //$parents = static::deleteAll($where);
		$arr = ['is_deleted'=>1];
		$model = static::findOne($data['id']);
		if (!$model->load($arr, '')) {
            return false;
        }
        return $model->save();
    } 
	/*
     * 添加家长留言
     * @return array
    */
	public static function addVote($data)
    {
		$model = new Vote();		
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
		
    }
	/*
     * 修改家长留言
     * @return array
    */
	public static function updateVote($data)
    {
		$model = static::findOne($data['id']);
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
    }
}
