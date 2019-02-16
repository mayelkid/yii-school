<?php

namespace backend\models;

use Yii;
use backend\models\Subject;
use backend\models\Teacher;

/**
 * This is the model class for table "{{%teacher_course}}".
 *
 * @property int $id
 * @property int $sid
 * @property int $teacher_id
 * @property int $subject_id
 * @property string $grade
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class TeacherCourse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%teacher_course}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid', 'course_id', 'status','teacher_id', 'subject_id', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
            [['course_name','teacher_name'], 'string', 'max' => 10],
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
            'course_id' => 'Course ID',
            'course_name' => 'Course Name',
            'teacher_id' => 'Teacher ID',
            'teacher_name' => 'Teacher Name',
            'subject_id' => 'Subject ID',
            'status' => 'Status',
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
     * 在修改后处理
     */
	public function afterSave($insert, $changedAttributes)
    {
		
		if(empty($this->course_id)){
			$model = static::findOne($this->id);
			$model->course_id = '2018'.str_pad($this->id, 5, '0',STR_PAD_LEFT);
			$model->save(); 
		}
		if($insert||!empty($changedAttributes['subject_id'])){
			$subject = Subject::findone(['subject_id'=>$this->subject_id]);
			if($subject){
				$model = static::findOne($this->id);
				$model->course_name = $subject->subject_name;
				$model->save(); 
			}
		}  
		if($insert||!empty($changedAttributes['teacher_id'])){
			$teacher = Teacher::findone(['teacher_id'=>$this->teacher_id]);
			if($teacher){
				$model = static::findOne($this->id);
				$model->teacher_name = $teacher->name;
				$model->save(); 
			}
		} 
		parent::afterSave($insert, $changedAttributes);		
    }
	 
	 /**
     * 查找课程
     */
	public static function findCourses($where)
    {
        $parents = static::find()->where($where)->asArray()->indexBy('id')->all();
        return $parents; 
    } 
}
