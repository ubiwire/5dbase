<?php

/**
 * This is the model class for table "{{reward_points}}".
 *
 * The followings are the available columns in table '{{reward_points}}':
 * @property integer $id
 * @property string $date
 * @property integer $total
 * @property integer $usage
 * @property integer $org_id
 * @property integer $status
 * @property string $create_at
 * @property string $update_at
 */
class RewardPoint extends CActiveRecord {

    const STATUS_ACTIVE = 0;
    const STATUS_BANNED = 1;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return RewardPoint the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{reward_points}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('date, total, status', 'required'),
            array('total, usage, org_id, status', 'numerical', 'integerOnly' => true),
            array('update_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, date, total, usage, org_id, status, create_at, update_at', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'org' => array(self::BELONGS_TO, 'Org', 'org_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'date' => Yii::t('reward', 'Date'),
            'total' => Yii::t('reward', 'Total'),
            'usage' => Yii::t('reward', 'Usage'),
            'org_id' => 'Org',
            'status' => Yii::t('reward', 'Status'),
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
        
        $criteria->condition = 'org_id=' . Yii::app()->user->org_id;
        $criteria->compare('id', $this->id);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('total', $this->total);
        $criteria->compare('usage', $this->usage);
//        $criteria->compare('org_id', $this->org_id);
        $criteria->compare('status', $this->status);
//        $criteria->compare('create_at', $this->create_at, true);
//        $criteria->compare('update_at', $this->update_at, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public static function itemAlias($type, $code = NULL) {
        $_items = array(
            'RewardPointStatus' => array(
                self::STATUS_ACTIVE => Yii::t('default', 'status active'),
                self::STATUS_BANNED => Yii::t('default', 'status banned'),
            ),
        );
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
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

    public function checkDate($time, $org_id) {
        $y = date("Y", $time);
        $m = date("m", $time);
//        $d = date("d", $time);
        $t0 = date('t');           // 本月一共有几天
        $t1 = mktime(0, 0, 0, $m, 1, $y);        // 创建本月开始时间
        $t2 = mktime(23, 59, 59, $m, $t0, $y);       // 创建本月结束时间
//        echo "taday" . date("Y-m-d", $time) . "<br>";
//        echo "begin" . date("Y-m-d H:i:s", $t1) . "<br>";
//        echo "end" . date("Y-m-d H:i:s", $t2) . "<br>";
//        echo "to：";
//        echo $t2 - $t1 . "<br>";

        return self::model()->count(array('condition' => ' org_id=:org_id and date>=:begintime and date<=:endtime', 'params' => array(':begintime' => $t1, ':endtime' => $t2, ':org_id' => $org_id)));
//        array('condition' => $attribute . '=:loginname', 'params' => array(':loginname' => $this->username));
//        Yii::app()->end();
    }

}