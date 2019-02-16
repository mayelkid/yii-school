<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%profile}}".
 *
 * @property int $id
 * @property int $type_id
 * @property int $sid
 * @property string $student_id
 * @property string $content
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'sid', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
            [['content'], 'string'],
            [['student_id'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Type ID',
            'sid' => 'Sid',
            'student_id' => 'Student ID',
            'content' => 'Content', 
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
