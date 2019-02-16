<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%choosetasks}}".
 *
 * @property int $id
 * @property string $name
 * @property string $grade
 * @property int $checkstarttime
 * @property int $checkendtime
 * @property int $choosestarttime
 * @property int $chooseendtime
 * @property int $status
 * @property string $amount
 * @property int $flag
 * @property string $opertime
 * @property int $sid
 * @property int $created_at
 * @property int $creatorid
 * @property int $update_at
 * @property int $updatorid
 * @property int $is_deleted
 */
class Choosetasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%choosetasks}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'amount', 'checkstarttime','checkendtime','choosestarttime','chooseendtime', 'status', 'flag', 'sid', 'created_at', 'creatorid', 'updated_at', 'updatorid', 'is_deleted'], 'integer'],
            [['name', 'grade', 'opertime'], 'string', 'max' => 50],
            [['id'], 'unique'],
        ];
    }
						
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()		
    {
        return [
            'id' => 'ID',
            'name' => 'Name',				
            'grade' => 'Grade',
            'checkstarttime' => 'Checkstarttime',
            'checkendtime' => 'Checkendtime',
            'choosestarttime' => 'Choosestarttime',
            'chooseendtime' => 'Chooseendtime',
            'status' => 'Status',
            'amount' => 'Amount',
            'flag' => 'Flag',
            'opertime' => 'Opertime',
            'sid' => 'Sid',
            'created_at' => 'Created At',
            'creatorid' => 'Creatorid',
            'updated_at' => 'Updated At',
            'updatorid' => 'Updatorid',
            'is_deleted' => 'Is Deleted',
        ];
    }
	// 验证之前的处理
    public function beforeValidate()
    {
        if (! empty($this->checkstarttime) && strpos($this->checkstarttime, '-')) $this->checkstarttime = strtotime($this->checkstarttime);
        if (! empty($this->checkendtime) && strpos($this->checkendtime, '-')) $this->checkendtime = strtotime($this->checkendtime);
		if (! empty($this->choosestarttime) && strpos($this->choosestarttime, '-')) $this->choosestarttime = strtotime($this->choosestarttime);
		if (! empty($this->chooseendtime) && strpos($this->chooseendtime, '-')) $this->chooseendtime = strtotime($this->chooseendtime);
        return parent::beforeValidate();
    }
	/**
     * 查找选课任务
     */
	public static function findChoosetaskid($where)
    {
        $parents = static::find()->where($where)->asArray()->indexBy('id')->all();
        
        return $parents; 
    }  
	/**
     * 在插入前处理
     */
	public function beforeSave($insert)
    {		
        if ($this->isNewRecord) {
			// 新增记录
			$this->sid = '410004001';
			$this->created_at = time();
			$this->is_deleted = '0';
        }
		$this->updated_at = time();
        return parent::beforeSave($insert);
	}
	
	/**
	 * 获取
     * @param integer|array $where 查询条件
     * @return array
     */
    public static function findChoosetasks($where)
    {		
		$where['is_deleted'] = 0;
		if(isset($where['key']) && $where['key'] !== ''){
			$key = $where['key'];unset($where['key']);
		}
		
		$db = static::find()->where($where)->asArray()->indexBy('id');
		if(isset($key) && $key !== ''){
			$db->andwhere(['like', 'name', $key]);
		}
		$parents = $db->all();
        return $parents; 
    } 				
	/*
     * 删除
     * @return array
    */ 
    public static function delChoosetasks($data)
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
     * 添加
     * @return array
    */
	public static function addChoosetasks($data)
    {
		$model = new Choosetasks();
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
		
    }
	/*
     * 修改
     * @return array		
    */
	public static function updateChoosetasks($data)
    {
		$model = static::findOne($data['id']);
		if (!$model->load($data, '')) {
            return false;
        }
        return $model->save();
    }
}
