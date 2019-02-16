<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%card}}".
 *
 * @property int $id
 * @property int $sid
 * @property string $card
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class Card extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%card}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid', 'status', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
            [['card'], 'string', 'max' => 11],
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
            'card' => 'Card',
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
     * 查找卡号
     */
	public static function findCards($where) 
    {
        $parents = static::find()->where($where)->asArray()->indexBy('id')->all();
        
        return $parents; 
    } 
	
	/**
     * 修改卡号
     */
	public function updateCard($id)
	{
		$card = static::findOne($id);
		$card->status=1;
		return $card->save(); 
	}
} 
