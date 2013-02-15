<?php

/**
 * This is the model class for table "{{reply}}".
 *
 * The followings are the available columns in table '{{reply}}':
 * @property integer $notice_id
 * @property integer $profile_id
 * @property string $modified
 * @property integer $replied_id
 */
class Reply extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Reply the static model class
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
		return '{{reply}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('notice_id, profile_id, modified', 'required'),
			array('notice_id, profile_id, replied_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('notice_id, profile_id, modified, replied_id', 'safe', 'on'=>'search'),
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
                     'user' => array(self::BELONGS_TO, 'User', 'profile_id'),
                    'notice' => array(self::BELONGS_TO, 'Notice', 'notice_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'notice_id' => 'Notice',
			'profile_id' => 'Profile',
			'modified' => 'Modified',
			'replied_id' => 'Replied',
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

		$criteria->compare('notice_id',$this->notice_id);
		$criteria->compare('profile_id',$this->profile_id);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('replied_id',$this->replied_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}