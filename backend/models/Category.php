<?php

/**
 * This is the model class for table "{{categories}}".
 *
 * The followings are the available columns in table '{{categories}}':
 * @property integer $id
 * @property integer $org_id
 * @property string $name
 * @property integer $user_id
 * @property string $create_at
 * @property string $update_at
 */
class Category extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Category the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{categories}}';
    }

    //获取分类列表，在添加礼品的时候需要用到
    public static function getCategoryList() {
        $models = self::model()->current()->findAll();
        $result = array();
        foreach ($models as $value) {
            $result[$value->id] = $value->name;
        }
        return $result;
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('org_id, name, user_id', 'required'),
            array('org_id, user_id', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 25),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, org_id, name, user_id, create_at, update_at', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'products' => array(self::HAS_MANY, 'Product', 'category_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'org_id' => Yii::t('category', 'Org Id'),
            'name' => Yii::t('category', 'Name'),
            'user_id' => Yii::t('category', 'User Id'),
            'create_at' => Yii::t('default', 'Create At'),
            'update_at' => Yii::t('default', 'Update At'),
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
        $criteria->compare('org_id', $this->org_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('create_at', $this->create_at, true);
        $criteria->compare('update_at', $this->update_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

//    protected function beforeSave() {
//        if ($this->isNewRecord) {
//            if ($this->hasAttribute('created_at')) {
//                $this->created_at = Date('Y-m-d H:i:s');
//            }
//             if ($this->hasAttribute('created_at')) {
//                $this->created_at = Date('Y-m-d H:i:s');
//            }
//        }
//        return parent::beforeSave();
//    }


    public function scopes() {
        return array(
            'current' => array(
                'condition' => 'org_id=' . Yii::app()->user->org_id,
            ),
        );
    }

}