<?php

/**
 * This is the model class for table "{{sms}}".
 *
 * The followings are the available columns in table '{{sms}}':
 * @property integer $id
 * @property integer $from_uid
 * @property integer $to_uid
 * @property string $mobile
 * @property string $content
 * @property string $sendtime
 * @property string $status
 * @property string $remark
 */
class Sms extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Sms the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{sms}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('mobile,content', 'required'),
            array('from_uid, to_uid', 'numerical', 'integerOnly' => true),
            array('mobile', 'length', 'max' => 11),
            array('content, sendtime, status, remark', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, from_uid, to_uid, mobile, content, sendtime, status, remark', 'safe', 'on' => 'search'),
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

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'from_uid' => t('From Uid'),
            'to_uid' => t('To Uid'),
            'mobile' => t('Mobile'),
            'content' => t('Content'),
            'sendtime' => t('Sendtime'),
            'status' => t('Status'),
            'remark' => t('Remark'),
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
        $criteria->compare('from_uid', $this->from_uid);
        $criteria->compare('to_uid', $this->to_uid);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('sendtime', $this->sendtime, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('remark', $this->remark, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function Send($message, $tonumber, $time, $toModel = null) {
        $message = mb_convert_encoding($message, 'UTF-8', 'UTF-8,GBK,GB2312');
        //Yii::import('application.modules.profile.models.*');
        $return_val = array();
        $sms_obj = SmsSetup::model()->find('isactive = 0 and user_id=' . Yii::app()->user->id);
        if (empty($sms_obj) && $tonumber) {
            Yii::import('application.modules.sms.components.provider.' . $sms_obj[0]->providertype);
            $serb_obj = new $sms_obj[0]->providertype;
            if (!is_array($tonumber)) {
                $tonumber[] = $tonumber;
            }
            $c = count($tonumber);
            for ($i = 0; $i < $c; $i += 50) {
                $retval = $serb_obj->send($sms_obj[0]->username, $sms_obj[0]->password, $message, array_slice($tonumber, $i, 50), $time, $sms_obj[0]->parameters);
                $return_val = array_merge($return_val, $retval);
            }
            foreach ($return_val as $ret) {
                $Sms = new Sms;
                $arr_tmp['to_uid'] = 0;
                $arr_tmp['from_uid'] = Yii::app()->user->id;
                $arr_tmp['content'] = $message;
                $arr_tmp['sendtime'] = $time ? $time : date('Y-m-d H:i:s');
                $arr_tmp['mobile'] = $ret['mobile'];
                $arr_tmp['status'] = $ret['return_msg'];
                $Sms->attributes = $arr_tmp;
                $Sms->save();
                //}
            }
        }
        return $return_val;
    }

}