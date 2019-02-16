<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%vote_record}}".
 *
 * @property int $id
 * @property int $vote_id
 * @property int $option_id
 * @property int $student_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class VoteRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vote_record}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'vote_id', 'option_id', 'student_id', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vote_id' => 'Vote ID',
            'option_id' => 'Option ID',
            'student_id' => 'Student ID',
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
	
	 
}
