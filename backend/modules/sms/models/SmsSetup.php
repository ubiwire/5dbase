<?php

/**
 * This is the model class for table "{{sms_setup}}".
 *
 * The followings are the available columns in table '{{sms_setup}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $providertype
 * @property string $parameters
 * @property integer $isactive
 */
class SmsSetup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SmsSetup the static model class
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
		return '{{sms_setup}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('isactive', 'numerical', 'integerOnly'=>true),
			array('username, password', 'length', 'max'=>64),
			array('providertype', 'length', 'max'=>32),
			array('parameters', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, providertype, parameters, isactive', 'safe', 'on'=>'search'),
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
			'username' => t('Username'),
			'password' => t('Password'),
			'providertype' => t('Providertype'),
			'parameters' => t('Parameters'),
			'isactive' => t('Isactive'),
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
        $criteria->compare('school_id',$this->school_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('providertype',$this->providertype,true);
		$criteria->compare('parameters',$this->parameters,true);
		$criteria->compare('isactive',$this->isactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function itemAlias($type, $code=NULL) {
		$_items = array(
				'isActive' => array(
					'0' => t('Yes'),
					'1' => t('No'),
					),
				);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}
    
    public function getBalance($id)
	{
		$sms_obj = SmsSetup::model()->findByPk($id);
		if($sms_obj){
			Yii::import('application.modules.sms.components.provider.'.$sms_obj->providertype);
			$serb_obj = new $sms_obj->providertype;
		    $return_val = $serb_obj->getBalance($sms_obj->username,	$sms_obj->password,$sms_obj->parameters);
            if(stristr($return_val,'http Status')){
                $return_val = t('Query Failed');
            }
            //var_dump((array)simplexml_load_string($return_val));
			return $return_val;
		}
	}
    
    public function getIsactiveImg($id){
        $sms_obj = SmsSetup::model()->findByPk($id);
        if($sms_obj->isactive){
            $imgUrl = Yii::app()->theme->baseUrl.'/images/small_icons/delete.png';
            $alt=t('Active');
        }else{
            $imgUrl = Yii::app()->theme->baseUrl.'/images/small_icons/accept.png';
            $alt=t('Banned');
        }
        
        $image = CHtml::image($imgUrl,$alt,array('title'=>$alt));
        return CHtml::link($image, array('/sms/smsSetup/ajaxupdate','id'=>$id),array("class"=>"ajaxupdate"));

    }
}