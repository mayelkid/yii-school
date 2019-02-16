<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%attendance}}".
 *
 * @property int $id
 * @property int $sid
 * @property int $card_id
 * @property int $type_id
 * @property int $time
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class Attendance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%attendance}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid', 'card_id', 'type_id', 'time', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
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
            'card_id' => 'Card ID',
            'type_id' => 'Type ID',
            'time' => 'Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
        ];
    }
	/**
     * 在插入之前处理
     */
	public function beforeSave($insert)
    {		
		
        if ($this->isNewRecord) {
			$this->sid = '410004001';
			$this->created_at = time();
			$this->is_deleted = '0';
        }
		$this->updated_at = time();
        return parent::beforeSave($insert);
	}
}
