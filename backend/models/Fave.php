<?php

/**
 * This is the model class for table "{{fave}}".
 *
 * The followings are the available columns in table '{{fave}}':
 * @property integer $notice_id
 * @property integer $user_id
 * @property string $uri
 * @property string $modified
 */
class Fave extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fave the static model class
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
		return '{{fave}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('notice_id, user_id, modified', 'required'),
			array('notice_id, user_id', 'numerical', 'integerOnly'=>true),
			array('uri', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('notice_id, user_id, uri, modified', 'safe', 'on'=>'search'),
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
			'notice_id' => 'Notice',
			'user_id' => 'User',
			'uri' => 'Uri',
			'modified' => 'Modified',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('uri',$this->uri,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}