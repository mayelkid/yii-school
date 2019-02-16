<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%leave}}".
 *
 * @property int $id
 * @property int $sid
 * @property string $title 请假事件
 * @property string $content
 * @property int $start_time
 * @property int $end_time
 * @property int $fid
 * @property int $cid
 * @property int $class
 * @property int $status
 * @property string $reply
 * @property int $rid
 * @property int $reply_time
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class Leave extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%leave}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid','fid', 'cid', 'class', 'status', 'rid', 'reply_time', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
            [['title'], 'string', 'max' => 50],
			[['start_time', 'end_time'], 'string', 'max' => 20],
            [['content', 'reply'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sid' => 'Sid',
            'title' => 'Title',
            'content' => 'Content',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'fid' => 'Fid',
            'cid' => 'Cid',
            'class' => 'Class',
            'status' => 'Status',
            'reply' => 'Reply',
            'rid' => 'Rid',
            'reply_time' => 'Reply Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
        ];
    }
	
	/**
     * 在插入前处理
     */
	public function beforeSave($insert) 
    {		
		// 新增记录
        if ($this->isNewRecord) {
			
			$this->sid = '410004001';
			$this->created_at = time();
			$this->is_deleted = '0';
        }
		$this->updated_at = time();
        return parent::beforeSave($insert); 
	}
	
	/**
	 *	获取请假信息
     * @param integer|array $where 查询条件
     * @return array
     */
    public static function findLeave($where)
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
     * 删除请假信息
     * @return array
    */ 
    public static function delLeave($data)
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
     * 添加请假信息
     * @return array
    */
	public static function addLeave($data)
    {
		$model = new Leave();
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
		
    }
	/*
     * 修改请假信息
     * @return array
    */
	public static function updateLeave($data)
    {
		$model = static::findOne($data['id']);
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
    }
}
