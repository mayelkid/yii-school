<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%choosetaskgroups}}".
 *
 * @property int $id
 * @property int $sid
 * @property int $choosetaskid
 * @property string $coursegroupids
 * @property string $coursegroupname
 * @property int $created_at
 * @property int $creatorid
 * @property int $update_at
 * @property int $updatorid
 * @property int $is_deleted
 */
class Choosetaskgroups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%choosetaskgroups}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid', 'choosetaskid', 'created_at', 'creatorid', 'updated_at', 'updatorid', 'is_deleted'], 'integer'],
			[['coursegroupids','coursegroupname'], 'string', 'max' => 100],
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
            'choosetaskid' => 'Choosetaskid',
            'coursegroupids' => 'Coursegroupids',
            'coursegroupname' => 'Coursegroupname',
            'created_at' => 'Created At',
            'creatorid' => 'Creatorid',
            'updated_at' => 'Updated At',
            'updatorid' => 'Updatorid',
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
	/**
     * 修改之后的处理
     */
	public function afterSave($insert, $changedAttributes)
    {
		
		parent::afterSave($insert, $changedAttributes);		
    }
	/**
     * 查找学生
     */
	public static function findGroupstudents($where)
    {
        $parents = static::find()->where($where)->asArray()->indexBy('id')->all();
        
        return $parents; 
    } 
}
