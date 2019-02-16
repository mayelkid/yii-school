<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%profile_type}}".
 *
 * @property int $id
 * @property string $title
 */
class ProfileType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profile_type}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			[['sid'], 'integer'],
            [['title'], 'string', 'max' => 20],
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
     *
     *查询档案type
     * @param integer|array $where 查询条件
     * @return array
     */
    public static function findProfileTypes($where)
    {
        $parents = static::find()->where($where)->asArray()->indexBy('id')->all();
        
        return $parents; 
    } 
}
