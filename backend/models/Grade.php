<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%grade}}".
 *
 * @property int $id
 * @property int $sid
 * @property string $name
 * @property string $manager
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class Grade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%grade}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid', 'cid', 'pid', 'created_at', 'updated_at', 'is_deleted','manager','classroom'], 'integer'],
            [['name'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [ 
            'id' => 'ID',
            'cid' => 'Cid',
            'pid' => 'Pid',
            'sid' => 'Sid',
            'name' => 'Name',
            'manager' => 'Manager',
            'classroom' => 'Classroom',
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
			if($this->cid && static::find()->where(['sid'=>'410004001','cid'=>$this->cid])->one()){
				return $this->addError('cid', 'The token must contain letters or digits.');
			}
			$this->sid = '410004001';
			$this->created_at = time();
			$this->is_deleted = '0';
        }else{
			if($this->cid && static::find()->where(['sid'=>'410004001','cid'=>$this->cid])->andWhere(['<>','id',$this->id])->one()){
				return $this->addError('cid', 'The token must contain letters or digits.');
			}
		}
		$this->updated_at = time();
        return parent::beforeSave($insert);
	}
	
	/**
     * 修改之后的处理
     * @param bool $insert
     * @param array $changedAttributes
     * @return bool
     */
	public function afterSave($insert, $changedAttributes)
    {
		
		if(empty($this->cid)){
			$model = static::findOne($this->id);
			$model->cid = (static::find()->where('sid=410004001')->max('cid'))+1;
			$model->save();  
		}
		parent::afterSave($insert, $changedAttributes);		
    }
	
	/**
     *
     *
     * @param integer|array $where 查询条件
     * @return array
     */
    public static function findGrades($where)
    {
        $parents = static::find()->where($where)->asArray()->indexBy('id')->all();
        /*if ($parents) {
            $arrParentIds = [];
            foreach ($parents as $value) {
                if ($value['pid'] != 0 && !isset($parents[$value['pid']])) {
                    $arrParentIds[] = $value['pid'];
                }
            }

            if ($arrParentIds) {
                $arrParents = static::findGrades(['cid' => $arrParentIds]);
                if ($arrParents) {
                    $parents += $arrParents;
                }
            }
        }*/
		//print_r($parents);exit;

        return $parents; 
    }
}
