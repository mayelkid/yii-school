<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%vote}}".
 *
 * @property int $id
 * @property int $sid
 * @property string $title
 * @property string $content
 * @property string $option
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class Vote extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vote}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['content'], 'string', 'max' => 255],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
        ];
    }
	
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
	 *	获取投票信息
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
		if(!empty($key) && $key !== ''){
			$db->andwhere(['like', 'title', $key]);
		}
		$parents = $db->all();
        return $parents; 
    } 			
	
	/*
     * 删除投票信息
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
     * 添加投票信息
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
     * 修改投票信息
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
