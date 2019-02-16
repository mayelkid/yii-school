<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%children}}".
 *
 * @property int $id
 * @property string $kid
 * @property string $cardno
 * @property string $cname
 * @property string $cclass
 * @property string $csex
 * @property string $cbirth
 * @property string $caddress
 * @property string $video
 * @property string $chead
 * @property int $isvip
 * @property string $viptime
 */
class Children extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%children}}';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cardno', 'cname',], 'required'],
            [['isvip'], 'integer'],
            [['kid', 'cclass', 'cbirth'], 'string', 'max' => 10],
            [['cardno'], 'string', 'max' => 50],
            [['cname'], 'string', 'max' => 20],
            [['csex'], 'string', 'max' => 5],
            [['caddress'], 'string', 'max' => 30],
            [['video'], 'string', 'max' => 2],
            [['chead'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '学生编号',
            'kid' => '学校编号',
            'cardno' => '卡号',
            'cname' => '姓名',
            'cclass' => '班级',
            'csex' => '性别',
            'cbirth' => '生日',
            'caddress' => '地址',
            'video' => '视频',
            'chead' => '头像',
            'isvip' => '会员',
            'viptime' => '会员时间',
        ];
    }
	/**
     * 在插入前处理
     */
	public function beforeSave($insert)
    {		
		// 新增记录和修改了密码
        if ($this->isNewRecord) {
			$this->kid = '410004001';
        }
        return parent::beforeSave($insert);
	}
}
