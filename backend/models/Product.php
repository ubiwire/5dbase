<?php

/**
 * This is the model class for table "{{productions}}".
 *
 * The followings are the available columns in table '{{productions}}':
 * @property integer $id
 * @property string $name
 * @property integer $price
 * @property string $descriptor
 * @property string $original_pic_path
 * @property string $process_picture_path
 * @property integer $org_id
 * @property integer $inventory
 * @property integer $category_id
 * @property integer $status
 * @property string $create_at
 * @property string $update_at
 */
class Product extends CActiveRecord {

    const STATUS_ACTIVE = 0;
    const STATUS_BANNED = 1;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Product the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{productions}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, price, org_id, inventory, category_id, status, descriptor, original_pic_path', 'required'),
            array('name', 'nameValidate'),
            array('status', 'in', 'range' => array(self::STATUS_ACTIVE, self::STATUS_BANNED)),
            array('price, org_id, inventory, category_id, status', 'numerical', 'integerOnly' => true),
            array('name, original_pic_path, process_picture_path', 'length', 'max' => 255),
            array('create_at', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
            array('update_at', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
            array('descriptor, update_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, price, descriptor, original_pic_path, process_picture_path, org_id, inventory, category_id, status, create_at, update_at', 'safe', 'on' => 'search'),
        );
    }
    
      /**
     * @return boolean for rules.
     * 在同一个组织里，礼品分类不能重复
     */
    public function nameValidate($attribute, $params) {
        if ($this->isNewRecord) {
            
            $_count = self::model()->count(array(
                'condition' => 'org_id=:org_id and name=:name',
                'params' => array(':org_id' => Yii::app()->user->org_id, ':name' => $this->name)));
            if ($_count > 0) {
                $this->addError('name', Yii::t('product', "This product's name already exists."));
            }
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('product', 'ID'),
            'name' => Yii::t('product', 'Name'),
            'price' => Yii::t('product', 'Price'),
            'descriptor' => Yii::t('product', 'Descriptor'),
            'original_pic_path' => Yii::t('product', 'Original Pic Path'),
            'process_picture_path' => Yii::t('product', 'Process Picture Path'),
            'org_id' => Yii::t('product', 'Org'),
            'inventory' => Yii::t('product', 'Inventory'),
            'category_id' => Yii::t('product', 'Category'),
            'status' => Yii::t('product', 'Status'),
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
 $criteria->condition = 'org_id=' . Yii::app()->user->org_id;
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('price', $this->price);
        $criteria->compare('descriptor', $this->descriptor, true);
//        $criteria->compare('original_pic_path', $this->original_pic_path, true);
//        $criteria->compare('process_picture_path', $this->process_picture_path, true);
//        $criteria->compare('org_id', $this->org_id);
        $criteria->compare('inventory', $this->inventory);
        $criteria->compare('category_id', $this->category_id);
        $criteria->compare('status', $this->status);
//        $criteria->compare('create_at', $this->create_at, true);
//        $criteria->compare('update_at', $this->update_at, true);
     //   $criteria->condition = 'org_id =' . Yii::app()->user->org_id;

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
//                    'pagination' => array(
//                        'pageSize' => 8,
//                    ),
                ));
    }

    public function scopes() {
        return array(
            'active' => array(
                'condition' => 'status=' . self::STATUS_ACTIVE,
            ),
            'banned' => array(
                'condition' => 'status=' . self::STATUS_BANNED,
            ),
        );
    }

    protected function beforeSave() {
//        if ($this->isNewRecord) {
//            if ($this->hasAttribute('status')) {
//                $this->status = self::STATUS_BANNED;
//            }
//        }
        return parent::beforeSave();
    }

    public static function itemAlias($type, $code = NULL) {
        $_items = array(
            'ProductStatus' => array(
                self::STATUS_ACTIVE => Yii::t('product', 'status active'),
                self::STATUS_BANNED => Yii::t('product', 'status banned'),
            ),
        );
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }

}