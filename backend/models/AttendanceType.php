<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%attendance_type}}".
 *
 * @property int $id
 * @property int $type_id
 * @property string $type_name
 */
class AttendanceType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%attendance_type}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id'], 'integer'],
            [['type_name'], 'string', 'max' => 10],
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
            'type_name' => 'Type Name',
        ];
    }
	/**
     *	获取考勤记录类型
     */
	public static function findAttendanceTypes($where)
    {
        $parents = static::find()->where($where)->asArray()->indexBy('id')->all();
        
        return $parents; 
    } 
}
