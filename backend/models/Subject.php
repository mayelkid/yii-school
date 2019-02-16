<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%subject}}".
 *
 * @property int $id
 * @property int $sid
 * @property int $subject_id
 * @property string $subject_name
 * @property int $is_required
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%subject}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid', 'subject_id', 'is_required', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
            [['subject_name'], 'string', 'max' => 10],
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
            'subject_id' => 'Subject ID',
            'subject_name' => 'Subject Name',
            'is_required' => 'Is Required',
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
			if($this->subject_id && static::find()->where(['sid'=>'410004001','subject_id'=>$this->subject_id])->one()){
				return $this->addError('subject_id', 'The token must contain letters or digits.');
			}
			$this->sid = '410004001';
			$this->created_at = time();
			$this->is_deleted = '0';
        }else{
			if($this->subject_id && static::find()->where(['sid'=>'410004001','subject_id'=>$this->subject_id])->andWhere(['<>','id',$this->id])->one()){
				return $this->addError('subject_id', 'The token must contain letters or digits.');
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
		
		if(empty($this->subject_id)){
			$model = static::findOne($this->id);
			$model->subject_id = (static::find()->where('sid=410004001')->max('subject_id'))+1;
			$model->save();  
		}
		parent::afterSave($insert, $changedAttributes);		
    }
	
	/**
	 *	获取科目信息
     * @param integer|array $where 查询条件
     * @return array
     */
	 public static function findSubjects($where)
    {
		$where['is_deleted'] = 0;
		$parents = static::find()->where($where)->asArray()->indexBy('id')->all();
        return $parents;
    } 
	/*
     * 删除科目
     * @return array
    */ 
    public static function delSubject($data)
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
     * 添加科目信息
     * @return array
    */
	public static function addSubject($data)
    {
		$model = new Subject();
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
		
    }
	/*
     * 修改科目信息
     * @return array
    */
	public static function updateSubject($data)
    {
		$model = static::findOne($data['id']);
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
    }
}
