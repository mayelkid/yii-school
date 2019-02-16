<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%circle}}".
 *
 * @property int $id
 * @property int $sid
 * @property string $title
 * @property string $content
 * @property string $thumb
 * @property string $arcrank
 * @property int $click
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class Circle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%circle}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sid', 'click', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
            [['title', 'arcrank'], 'string', 'max' => 50],
            [['content'], 'string', 'max' => 255],
            [['pic'], 'string', 'max' => 500],
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
			'arcrank' => 'Arcrank',
            'click' => 'Click',
            'title' => 'Title',
            'content' => 'Content',
            'pic' => 'Pic',
			'video' => 'Video',
			'num' => 'Num',
			'likenum' => 'Likenum',
			'mid' => 'Mid',
			'status' => 'Status',
			'is_show' => 'Is Show',
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
			$this->mid = '410004001';
        }
		$this->updated_at = time();
        return parent::beforeSave($insert);
	}
	
	/**
	 *	获取班级圈
     * @param integer|array $where 查询条件
     * @return array
     */
    public static function findCircle($where)
    {		
		$where['is_deleted'] = 0;
		if(isset($where['key']) && $where['key'] !== ''){
			$key = $where['key'];unset($where['key']);
		}
		$db = static::find()->where($where)->asArray()->indexBy('id');
		if(isset($key) && $key !== ''){
			$db->andwhere(['like', 'title', $key])->orwhere(['like', 'content', $key]);
		}
		$parents = $db->all();
        return $parents; 
    } 			
	
	/*
     * 删除班级圈
     * @return array
    */ 
    public static function delCircle($data)
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
     * 添加班级圈
     * @return array
    */
	public static function addCircle($data)
    {
		$model = new Circle();
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
		
    }
	/*
     * 修改班级圈
     * @return array
    */
	public static function updateCircle($data)
    {
		$model = static::findOne($data['id']);
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
    }
}
