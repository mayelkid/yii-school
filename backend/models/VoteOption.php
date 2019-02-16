<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%vote_option}}".
 *
 * @property int $id
 * @property int $vid
 * @property int $student_id
 * @property string $option
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class VoteOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vote_option}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vote_id',  'created_at', 'updated_at', 'is_deleted'], 'integer'],
            [['option'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vote_id' => 'Vote Id',
            'option' => 'Option',
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
     * 查询选项
     */
	public static function findOption($where)
    {
        $parents = static::find()->where($where)->asArray()->indexBy('id')->all();
        
        return $parents; 
    }
}
