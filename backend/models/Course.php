<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%course}}".
 *
 * @property int $id
 * @property int $sid
 * @property string $week
 * @property string $grade
 * @property string $subject
 * @property string $course_time
 * @property string $classroom
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%course}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid','week1','week2','week3','week4','week5','week6','week7','lesson', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
            [['grade'], 'string', 'max' => 10],
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
            'week1' => 'Week1',
            'week2' => 'Week2',
            'week3' => 'Week3',
            'week4' => 'Week4',
            'week5' => 'Week5',
            'week6' => 'Week6',
            'week7' => 'Week7',
            'grade' => 'Grade',
            'lesson' => 'Lesson',
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
	 *	查看课程
     * @param integer|array $where 查询条件
     * @return array
     */
    public static function findCourse($where)
    {		
		$where['is_deleted'] = 0;
		if(isset($where['key']) && $where['key'] !== ''){
			$key = $where['key'];unset($where['key']);
		}
		$db = static::find()->where($where)->asArray()->indexBy('id');
		if(isset($key) && $key !== ''){
			$db->andwhere(['like', 'grade', $key]);
		}
		$parents = $db->all();
        return $parents; 
    } 			
	
	/*
     * 删除课程
     * @return array
    */ 
    public static function delCourse($data)
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
     * 添加课程
     * @return array
    */
	public static function addCourse($data)
    {
		$model = new Course();
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
		
    }
	/*
     * 修改课程
     * @return array
    */
	public static function updateCourse($data)
    {
		$model = static::findOne($data['id']);
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
    }
}
