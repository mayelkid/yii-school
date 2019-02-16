<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%manager}}".
 *
 * @property int $id
 * @property int $sid
 * @property string $name
 * @property string $phone
 * @property string $ahead
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class Manager extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%manager}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
            [['name'], 'string', 'max' => 10],
            [['phone'], 'string', 'max' => 11],
            [['ahead'], 'string', 'max' => 255],
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
            'phone' => 'Phone',
            'ahead' => 'Ahead',
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
