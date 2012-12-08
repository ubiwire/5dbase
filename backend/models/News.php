<?php

/**
 * This is the model class for table "{{news}}".
 *
 * The followings are the available columns in table '{{news}}':
 * @property integer $id
 * @property integer $news_type
 * @property string $title
 * @property string $content
 * @property integer $org_id
 * @property integer $user_id
 * @property string $creaet_at
 * @property string $update_at
 */
class News extends CActiveRecord
{



const NEW_TYPE_JOY = 'joy';
const NEW_TYPE_SAYING = 'saying';
const NEW_TYPE_GAME = 'game';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return News the static model class
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
		return '{{news}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, org_id, user_id, creaet_at, update_at', 'required'),
			array('news_type, org_id, user_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, news_type, title, content, org_id, user_id, creaet_at, update_at', 'safe', 'on'=>'search'),
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
			'news_type' => Yii::t('news','News Type'),
			'title' => Yii::t('news','Title'),
			'content' => Yii::t('news','Content'),
			'org_id' => Yii::t('news','Org'),
			'user_id' => Yii::t('news','User'),
			'creaet_at' => Yii::t('news','Creaet At'),
			'update_at' => Yii::t('news','Update At'),
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
		$criteria->compare('news_type',$this->news_type);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('org_id',$this->org_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('creaet_at',$this->creaet_at,true);
		$criteria->compare('update_at',$this->update_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	 public static function itemAlias($type, $code = NULL) {
        $_items = array(
            'NewsType' => array(
                self::NEW_TYPE_JOY => Yii::t('news', 'joy'),
                self::NEW_TYPE_SAYING => Yii::t('news', 'saying'),
                self::NEW_TYPE_GAME => Yii::t('news', 'game'),
            ),
            
        );
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }
}