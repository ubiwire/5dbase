<?php

/**
 * This is the model class for table "{{reward_point_grant}}".
 *
 * The followings are the available columns in table '{{reward_point_grant}}':
 * @property integer $id
 * @property integer $org_id
 * @property integer $granter_id
 * @property integer $recipient_id
 * @property integer $reward_val
 * @property integer $granter_type
 * @property integer $usage
 * @property string $create_at
 * @property string $update_at
 * @property string $reason
 */
class RewardGrant extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RewardGrant the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{reward_point_grant}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_at, reason', 'required'),
			array('org_id, granter_id, recipient_id, reward_val, granter_type, usage', 'numerical', 'integerOnly'=>true),
			array('reason', 'length', 'max'=>255),
			array('update_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, org_id, granter_id, recipient_id, reward_val, granter_type, usage, create_at, update_at, reason', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'org_id' => 'Org',
			'granter_id' => Yii::t('reward', 'Granter'),
			'recipient_id' => Yii::t('reward', 'Recipient'),
			'reward_val' => Yii::t('reward', 'Reward Val'),
			'granter_type' => Yii::t('reward', 'Granter Type'),
			'usage' => Yii::t('reward', 'Usage'),
			'create_at' => 'Create At',
			'update_at' => 'Update At',
			'reason' => Yii::t('reward', 'Reason'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('org_id',$this->org_id);
		$criteria->compare('granter_id',$this->granter_id);
		$criteria->compare('recipient_id',$this->recipient_id);
		$criteria->compare('reward_val',$this->reward_val);
		$criteria->compare('granter_type',$this->granter_type);
		$criteria->compare('usage',$this->usage);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->compare('update_at',$this->update_at,true);
		$criteria->compare('reason',$this->reason,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}