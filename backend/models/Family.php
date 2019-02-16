<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%family}}".
 *
 * @property int $id
 * @property int $sid
 * @property int $student_id
 * @property string $name
 * @property string $sex
 * @property string $link
 * @property string $phone
 * @property string $birth
 * @property string $address
 * @property string $ahead
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class Family extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%family}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid', 'student_id', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
            [['name'], 'string', 'max' => 4],
            [['sex'], 'string', 'max' => 1],
            [['link'], 'string', 'max' => 10],
            [['phone'], 'string', 'max' => 11],
            [['birth', 'address'], 'string', 'max' => 20],
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
            'student_id' => 'Student ID',
            'name' => 'Name',
            'sex' => 'Sex',
            'link' => 'Link',
            'phone' => 'Phone',
            'birth' => 'Birth',
            'address' => 'Address',
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
	/*
     * 获取家长信息
     * @return array
    */ 
	public static function findFamily($where)
    {
		$where['is_deleted'] = 0;
		
		$pageNo = isset($where['pageNo'])? $where['pageNo']:'1';
        $pageSize = isset($where['pageSize'])? $where['pageSize']:'9';
        $pageNum=($pageNo-1)*$pageSize;
		if(isset($where['pageNo']) && $where['pageNo'] !== ''){
			unset($where['pageNo']);
		}
		if(isset($where['pageSize']) && $where['pageSize'] !== ''){
			unset($where['pageSize']);
		}
		
		if(isset($where['key']) && $where['key'] !== ''){
			$key = $where['key'];unset($where['key']);
		}
		$db = static::find()->where($where)->asArray()->indexBy('id');
		if(isset($key) && $key !== ''){
			$db->andwhere(['like', 'name', $key])->orwhere(['like', 'phone', $key]);
		}
		$parents = $db->offset($pageNum)->limit($pageSize)->all();
        return $parents;
    } 
	/*
     * 删除家长
     * @return array
    */ 
    public static function delFamily($data)
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
     * 添加家长信息
     * @return array
    */ 
	public static function addFamily($data)
    {
		$model = new Family();
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
		
    }
	/*
     * 修改家长信息
     * @return array
    */ 
	public static function updateFamily($data)
    {
		$model = static::findOne($data['id']);
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
		
    }
}
