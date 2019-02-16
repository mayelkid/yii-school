<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%chootaskstudents}}".
 *
 * @property int $id
 * @property int $choosetaskid
 * @property int $choosetaskgroupid
 * @property int $student_id
 * @property int $sid
 */
class Chootaskstudents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%chootaskstudents}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'choosetaskid', 'choosetaskgroupid', 'student_id', 'sid', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
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
            'choosetaskgroupid' => 'Choosetaskgroupid',
            'student_id' => 'Student ID',
            'sid' => 'Sid',
			'created_at' => 'Created At',
            'updated_at' => 'Update At',
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
