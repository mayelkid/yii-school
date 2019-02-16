<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%course_time}}".
 *
 * @property int $id
 * @property int $sid
 * @property string $course_time
 * @property int $has_earlyread
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class CourseTime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%course_time}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid', 'lesson', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
            [['name', 'starttime', 'endtime'], 'string'],
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
            'name' => 'Name',
            'lesson' => 'Lesson',
            'starttime' => 'Starttime',
            'endtime' => 'Endtime',
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
     * 查找课程时间
     */
	public static function findCourseTime($where)
    {
        $parents = static::find()->where($where)->asArray()->indexBy('id')->all();
        
        return $parents; 
    } 
}
