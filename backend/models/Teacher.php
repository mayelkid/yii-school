<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%teacher}}".
 *
 * @property int $id
 * @property int $sid
 * @property int $card_id
 * @property string $name
 * @property string $sex
 * @property string $grade
 * @property string $phone
 * @property string $birth
 * @property string $address
 * @property string $ahead
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%teacher}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid', 'card_id', 'created_at', 'updated_at', 'is_deleted','teacher_id'], 'integer'],
            [['name'], 'string', 'max' => 10],
            [['sex'], 'string', 'max' => 1],
			[['intro'], 'string'],
            [['grade'], 'string', 'max' => 10],
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
			'teacher_id' => 'Teacher ID',
            'card_id' => 'Card ID',
            'name' => 'Name',
            'sex' => 'Sex',
			'intro' => 'Intro',
            'grade' => 'Grade',
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
			if($this->teacher_id && static::find()->where(['sid'=>'410004001','teacher_id'=>$this->teacher_id])->one()){
				return $this->addError('teacher_id', 'The token must contain letters or digits.');
			}
			$this->sid = '410004001';
			$this->created_at = time();
			$this->is_deleted = '0';
        }else{
			if($this->teacher_id && static::find()->where(['sid'=>'410004001','teacher_id'=>$this->teacher_id])->andWhere(['<>','id',$this->id])->one()){
				return $this->addError('teacher_id', 'The token must contain letters or digits.');
			}
		}
		$this->updated_at = time();
        return parent::beforeSave($insert); 
	}
	/**
     * 在修改后处理
     */
	public function afterSave($insert, $changedAttributes)
    {
		if ($insert || !empty($changedAttributes['card_id'])) {
			
			Card::updateCard($this->card_id); 
		}
		if(empty($this->teacher_id)){
			$model = static::findOne($this->id);
			$model->teacher_id = '2018'.str_pad($this->id, 5, '0',STR_PAD_LEFT);
			$model->save(); 
		}
		parent::afterSave($insert, $changedAttributes);		
    }
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getGrade()
    {
        return $this->hasOne(Grade::className(), ['grade' => 'cid']);
    }
	
	/**
	 *	登录查询教师
     * @param integer|array $username 用户名
     * @return array		
     */
	public static function getclass($username) 
    {
		$db = static::findOne(['phone'=>$username]);
		return $db;
    }
	
	/**
	 *	登录查询教师
     * @param integer|array $username 用户名
     * @return array
     */
	public static function findByUsername($username) 
    {
		return static::findOne(['phone'=>$username]);
    } 
	
	/**
	 *	获取教师信息
     * @param integer|array $where 查询条件
     * @return array
     */
	public static function findTeachers($where) 
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
     * 删除教师
     * @return array
    */ 
    public static function delTeacher($data)
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
     * 添加教师信息
     * @return array
    */
	public static function addTeacher($data)
    {
		$model = new Teacher();
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
		
    }
	/*
     * 修改教师信息
     * @return array
    */
	public static function updateTeacher($data)
    {
		$model = static::findOne($data['id']);
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
    }
}
