<?php

/**
 * This is the model class for table "{{orgs}}".
 *
 * The followings are the available columns in table '{{orgs}}':
 * @property integer $id
 * @property string $name
 * @property string $slogan
 * @property string $photo_path
 * @property string $company_name
 * @property integer $parent_id
 * @property string $create_at
 * @property string $update_at
 */
class Org extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Org the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{orgs}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('parent_id', 'numerical', 'integerOnly' => true),
            array('name, slogan, photo_path, company_name', 'length', 'max' => 255),
            array('update_at', 'safe'),
            array('photo_path',
                'file',
                'allowEmpty' => true,
                'types' => 'jpg,gif,png',
                'maxSize' => 1024 * 1024 * 1,
                'tooLarge' => '头像最大不超过1MB，请重新上传!',
            ),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, slogan, company_name, parent_id, create_at, update_at', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'users' => array(self::HAS_MANY, 'User', 'org_id'),
            'news' => array(self::HAS_MANY, 'News', 'org_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t("org", 'ID'),
            'name' => Yii::t("org", 'Name'),
            'slogan' => Yii::t("org", 'Slogan'),
            'photo_path' => Yii::t("org", 'Photo Path'),
            'company_name' => Yii::t("org", 'Company Name'),
            'parent_id' => Yii::t("org", 'Parent'),
            'create_at' => Yii::t("org", 'Create At'),
            'update_at' => Yii::t("org", 'Update At'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('slogan', $this->slogan, true);
        $criteria->compare('photo_path', $this->photo_path, true);
        $criteria->compare('company_name', $this->company_name, true);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('create_at', $this->create_at, true);
        $criteria->compare('update_at', $this->update_at, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}