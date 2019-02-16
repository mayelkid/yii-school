<?php

namespace backend\models;

use Yii;
/**
 * This is the model class for table "{{%introduction_type}}".
 *
 * @property int $id
 * @property int $sid
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class IntroductionType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()	
    {
        return '{{%introduction_type}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['sid', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
            [['name'], 'string', 'max' => 50],
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
     *
     *查询校园风采type
     * @param integer|array $where 查询条件
     * @return array
     */
    public static function findIntroductionTypes($where)
    {
        $parents = static::find()->where($where)->asArray()->indexBy('id')->all();
        
        return $parents; 
    }
}
