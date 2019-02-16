<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%school}}".
 *
 * @property int $id
 * @property int $sid
 * @property string $title
 * @property string $content
 * @property string $thumb
 * @property string $arcrank
 * @property int $click
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class School extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%school}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sid', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
            [['phone'], 'string', 'max' => 11],
            [['name', 'email','location','province','city','area'], 'string', 'max' => 50]
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
            'email' => 'Email',
            'location' => 'Location',
            'province' => 'Province',
			'city' => 'City',
			'area' => 'Area',
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
        }
		$this->updated_at = time();
        return parent::beforeSave($insert);
	}
	
	/*
     * 获取学校编号
     * @return array
    */ 
	public static function getSid($username)
    {
		$db = static::findOne(['phone'=>$username]);
		return $db;
    }
	
	/*
     * 获取学校信息
     * @return array
    */ 
	public static function findSchool($where)
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
     * 删除学校
     * @return array
    */ 
    public static function delSchool($data)
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
     * 添加学校信息
     * @return array
    */
	public static function addSchool($data)
    {
		$model = new School();
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
    }
	/*
     * 修改学校信息
     * @return array
    */
	public static function updateSchool($data)
    {
		$model = static::findOne($data['id']);
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
    }
}
