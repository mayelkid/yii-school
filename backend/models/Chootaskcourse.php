<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%chootaskcourse}}".
 *
 * @property int $id
 * @property int $choosetaskid
 * @property int $student_id
 * @property int $coursegroupids
 * @property int $sid
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class Chootaskcourse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%chootaskcourse}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'choosetaskid', 'student_id', 'coursegroupids', 'sid', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
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
            'choosetaskid' => 'Choosetaskid',
            'student_id' => 'Student ID',
            'coursegroupids' => 'Coursegroupids',
            'sid' => 'Sid',
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
        if ($this->isNewRecord) {
			// 新增记录
			$this->sid = '410004001';
			$this->created_at = time();
			$this->is_deleted = '0';
        }
		$this->updated_at = time();
        return parent::beforeSave($insert);
	}
}
