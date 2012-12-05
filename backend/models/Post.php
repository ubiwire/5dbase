<?php

/**
 * This is the model class for table "{{posts}}".
 *
 * The followings are the available columns in table '{{posts}}':
 * @property integer $id
 * @property string $contents
 * @property integer $user_id
 * @property integer $comments_count
 * @property integer $like_count
 * @property integer $favorite_count
 * @property integer $public
 * @property integer $wb_type
 * @property integer $refer_id
 * @property integer $org_id
 * @property string $create_at
 * @property string $update_at
 */
class Post extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Post the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{posts}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('contents, user_id, org_id, create_at', 'required'),
            array('user_id, comments_count, like_count, favorite_count, public, wb_type, refer_id, org_id', 'numerical', 'integerOnly' => true),
            array('update_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, contents, user_id, comments_count, like_count, favorite_count, public, wb_type, refer_id, org_id, create_at, update_at', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    public function scopes() {
        return array(
            'recently' => array(
                'order' => 'create_at DESC',
                'limit' => 15,
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'contents' => 'Contents',
            'user_id' => 'User',
            'comments_count' => 'Comments Count',
            'like_count' => 'Like Count',
            'favorite_count' => 'Favorite Count',
            'public' => 'Public',
            'wb_type' => 'Wb Type',
            'refer_id' => 'Refer',
            'org_id' => 'Org',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
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
        $criteria->compare('contents', $this->contents, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('comments_count', $this->comments_count);
        $criteria->compare('like_count', $this->like_count);
        $criteria->compare('favorite_count', $this->favorite_count);
        $criteria->compare('public', $this->public);
        $criteria->compare('wb_type', $this->wb_type);
        $criteria->compare('refer_id', $this->refer_id);
        $criteria->compare('org_id', $this->org_id);
        $criteria->compare('create_at', $this->create_at, true);
        $criteria->compare('update_at', $this->update_at, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function recentlyList() {
        $dataProvider = new CActiveDataProvider('Post', array(
                    'criteria' => array(
                        'condition' => 'org_id='. Yii::app()->user->org_id,
                        'order' => 'create_at DESC',
                    ),
                    'pagination' => array(
                        'pageSize' => 1,
                    ),
                ));
        return $dataProvider->getData();
    }

}