<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%classroom}}".
 *
 * @property int $id
 * @property int $sid
 * @property int $classroom_id
 * @property string $classroom
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class Classroom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%classroom}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid', 'classroom_id', 'buildno', 'floor', 'houseno', 'limits', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
            [['classroom'], 'string', 'max' => 10],
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
            'classroom_id' => 'Classroom ID',
            'classroom' => 'Classroom',
            'buildno' => 'Buildno',
            'floor' => 'Floor',
            'houseno' => 'Houseno',
            'limits' => 'Limits',
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
			if($this->classroom_id && static::find()->where(['sid'=>'410004001','classroom_id'=>$this->classroom_id])->one()){
				return $this->addError('classroom_id', 'The token must contain letters or digits.');
			}
			$this->sid = '410004001';
			$this->created_at = time(); 
			$this->is_deleted = '0';
        }else{
			if($this->classroom_id && static::find()->where(['sid'=>'410004001','classroom_id'=>$this->classroom_id])->andWhere(['<>','id',$this->id])->one()){
				return $this->addError('classroom_id', 'The token must contain letters or digits.');
			}
		}
		$this->updated_at = time();
        return parent::beforeSave($insert);
	}
	/**
     * 修改之后的处理
     */
	public function afterSave($insert, $changedAttributes)
    {
		
		if(empty($this->classroom_id)){
			$model = static::findOne($this->id);
			$model->classroom_id = (static::find()->where('sid=410004001')->max('classroom_id'))+1;
			$model->save();  
		}
		parent::afterSave($insert, $changedAttributes);		
    }
	/*
     * 获取班级
     * @return array
    */
	public static function findClassroom($where)
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
			$db->andwhere(['like', 'name', $key]);
		}
		$parents = $db->offset($pageNum)->limit($pageSize)->all();
        return $parents;
    } 
	/*
     * 删除班级
     * @return array
    */ 
    public static function delClassroom($data)
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
     * 添加班级信息
     * @return array
    */
	public static function addClassroom($data)
    {
		$model = new Classroom();
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
		
    }
	/*
     * 修改班级信息
     * @return array
    */
	public static function updateClassroom($data)
    {
		$model = static::findOne($data['id']);
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
    }
}
