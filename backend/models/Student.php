<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%student}}".
 *
 * @property int $id
 * @property int $sid
 * @property int $student_id
 * @property int $card_id
 * @property string $name
 * @property string $sex
 * @property string $birth
 * @property string $ahead
 * @property string $grade
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%student}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid', 'created_at', 'updated_at', 'is_deleted','student_id'], 'integer'],
            [['name'], 'string', 'max' => 10],
            [['sex'], 'string', 'max' => 1],
			[['interest'], 'string', 'max' => 100],
			
            [['birth'], 'string', 'max' => 20],
            [['ahead'], 'string', 'max' => 255],
            [['grade'], 'string', 'max' => 10],
            [['card_id'], 'string', 'max' => 11],
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
            'card_id' => 'Card ID',
            'name' => 'Name',
            'sex' => 'Sex',
			'interest' => 'interest',
            'birth' => 'Birth',
            'ahead' => 'Ahead',
            'grade' => 'Grade',
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
        if ($this->isNewRecord) {
			// 新增记录
			if($this->student_id && static::find()->where(['sid'=>'410004001','student_id'=>$this->student_id])->one()){
				return $this->addError('student_id', 'The token must contain letters or digits.');
			}
			$this->sid = '410004001';
			$this->created_at = time();
			$this->is_deleted = '0';
        }else{
			if($this->student_id && static::find()->where(['sid'=>'410004001','student_id'=>$this->student_id])->andWhere(['<>','id',$this->id])->one()){
				return $this->addError('student_id', 'The token must contain letters or digits.');
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
			
			//Card::updateCard($this->card_id);
		}
		if(empty($this->student_id)){
			$model = static::findOne($this->id);
			$model->student_id = '2018'.str_pad($this->id, 5, '0',STR_PAD_LEFT);
			$model->save(); 
		}
		parent::afterSave($insert, $changedAttributes);		
    }
	 
	/**
     * 获取导入表格
     */
	public static function getStudentExcel()
    {
        $array =  Yii::t('app', 'student_excel');
        return $array;
    }
	
	/**
	 *	获取学生信息
     * @param integer|array $where 查询条件
     * @return array
     */
    public static function findStudents($where)
    {		
	
		//$where['is_deleted'] = 0;
		
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
		$db = static::find(['id,name'])->where($where)->asArray()->indexBy('id');
		if(isset($key) && $key !== ''){
			$db->andwhere(['like', 'name', $key])->orwhere(['like', 'card_id', $key]);
		}
		$parents = $db->offset($pageNum)->limit($pageSize)->all();
        return $parents; 
    } 			
	
	/*
     * 删除学生
     * @return array
    */ 
    public static function delStudent($data)
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
     * 添加学生信息
     * @return array
    */
	public static function addStudent($data)
    {
		$model = new Student();
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
		
    }
	/*
     * 修改学生信息
     * @return array
    */
	public static function updateStudent($data)
    {
		$model = static::findOne($data['id']);
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
    }
}
