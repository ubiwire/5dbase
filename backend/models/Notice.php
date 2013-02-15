<?php

/**
 * This is the model class for table "{{notice}}".
 *
 * The followings are the available columns in table '{{notice}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $org_id
 * @property string $uri
 * @property string $content
 * @property string $rendered
 * @property string $url
 * @property string $created
 * @property string $modified
 * @property integer $reply_to
 * @property integer $is_local
 * @property string $source
 * @property integer $conversation
 * @property string $lat
 * @property string $lon
 * @property integer $location_id
 * @property integer $location_ns
 * @property integer $repeat_of
 * @property string $object_type
 * @property string $verb
 * @property integer $scope
 */
class Notice extends CActiveRecord {
    /* Notice types */

    const LOCAL_PUBLIC = 1;
    const REMOTE = 0;
    const LOCAL_NONPUBLIC = -1;
    const GATEWAY = -2;
    const PUBLIC_SCOPE = 0; // Useful fake constant
    const SITE_SCOPE = 1;
    const ADDRESSEE_SCOPE = 2;
    const GROUP_SCOPE = 4;
    const FOLLOWER_SCOPE = 8;
    const POST = 'http://activitystrea.ms/schema/1.0/post';
    const NOTE = 'http://activitystrea.ms/schema/1.0/note';
    const COMMENT = 'http://activitystrea.ms/schema/1.0/comment';
    const DISPLAY_FMT = '[0-9a-zA-Z_]{1,64}';

    protected $_profile = -1;
    protected $_reply = null;

    const CANONICAL_FMT = '[0-9a-z]{1,64}';

    /**
     * Maximum number of characters in a canonical-form nickname.
     */
    const MAX_LEN = 64;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Notice the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{notice}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, org_id, created, modified', 'required'),
            array('user_id, org_id, reply_to, is_local, conversation, location_id, location_ns, repeat_of, scope', 'numerical', 'integerOnly' => true),
            array('uri, url, object_type, verb', 'length', 'max' => 255),
            array('source', 'length', 'max' => 32),
            array('lat, lon', 'length', 'max' => 10),
            array('content, rendered', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, org_id, uri, content, rendered, url, created, modified, reply_to, is_local, source, conversation, lat, lon, location_id, location_ns, repeat_of, object_type, verb, scope', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'org_id' => 'Org',
            'uri' => 'Uri',
            'content' => 'Content',
            'rendered' => 'Rendered',
            'url' => 'Url',
            'created' => 'Created',
            'modified' => 'Modified',
            'reply_to' => 'Reply To',
            'is_local' => 'Is Local',
            'source' => 'Source',
            'conversation' => 'Conversation',
            'lat' => 'Lat',
            'lon' => 'Lon',
            'location_id' => 'Location',
            'location_ns' => 'Location Ns',
            'repeat_of' => 'Repeat Of',
            'object_type' => 'Object Type',
            'verb' => 'Verb',
            'scope' => 'Scope',
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
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('org_id', $this->org_id);
        $criteria->compare('uri', $this->uri, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('rendered', $this->rendered, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('reply_to', $this->reply_to);
        $criteria->compare('is_local', $this->is_local);
        $criteria->compare('source', $this->source, true);
        $criteria->compare('conversation', $this->conversation);
        $criteria->compare('lat', $this->lat, true);
        $criteria->compare('lon', $this->lon, true);
        $criteria->compare('location_id', $this->location_id);
        $criteria->compare('location_ns', $this->location_ns);
        $criteria->compare('repeat_of', $this->repeat_of);
        $criteria->compare('object_type', $this->object_type, true);
        $criteria->compare('verb', $this->verb, true);
        $criteria->compare('scope', $this->scope);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public static function contentTooLong($content) {
        $contentlimit = 140;
        return ($contentlimit > 0 && !empty($content) && (mb_strlen($content) > $contentlimit));
    }

    public static function saveNew($user_id, $org_id, $lat, $lon, $text, $options) {
        $defaults = array(
            'scope' => 0,
            'distribute' => true,
            'verb' => self::POST,
            'user_id' => (int) $user_id,
            'org_id' => (int) $org_id,
            'content' => $text,
            'rendered' => $text,
            'lat' => $lat,
            'lon' => $lon,
            'source' => 'api',
        );

        if (!empty($options) && is_array($options)) {
            $options = array_merge($defaults, $options);
            // extract($options);
        } else {
            $options = $defaults;
        }

        $notice = new Notice;
        $notice->attributes = $options;

//        var_dump($options);
//        echo "==============";
//        var_dump($notice->attributes);
//        Yii::app()->end();

        if (!isset($notice->is_local)) {
            $notice->is_local = Notice::LOCAL_PUBLIC;
        }



        if (!empty($notice->reply_to)) {
            $reply = self::model()->findByPk($notice->reply_to);
            if ($reply) {
                $notice->object_type = self::COMMENT;
                $notice->reply_to = $reply->id;
                $notice->conversation = $reply->conversation;
                $notice->_reply = $reply;
            } else {
                throw new Exception('Parent notice not found.', 400);
            }
        }

//        if (empty($notice->uri)) {
//            $notice->uri = common_notice_uri($notice);
//        }
        // If it's not part of a conversation, it's
        // the beginning of a new conversation.

        $notice->created = date("Y-m-d H:i:s");
        $notice->modified = time();
//        var_dump($notice->attributes);
//        Yii::app()->end();

        if ($notice->save()) {
            if (empty($notice->uri)) {
                $notice->uri = Yii::app()->baseUrl . '/index.php/notice/' . $notice->id;
            }
            if (empty($notice->conversation)) {
                $conv = Conversation::create();
                $notice->conversation = $conv->id;
            }
            $notice->saveReplies();
            $notice->save();
        } else {
            throw new Exception(var_dump($notice->errors), 500);
        }
        return $notice;
    }

    //先过滤消息中的@ 然后如果是回复的话，在user_ids中加上回复对象的id,然后循环保存replies.
    function saveReplies() {
        // $user_ids = array();
        $user_ids = self::common_find_mentions($this->content, $this);
        //加上原帖回复的user_id
        if ($this->_reply) {
            $user_ids[] = $this->_reply->user_id;
        }
        $user_ids = array_unique($user_ids);
//        var_dump($user_ids);
//        Yii::app()->end();

        foreach ($user_ids as $user_id) {
            $reply = new Reply();
            $reply->notice_id = $this->id;
            $reply->profile_id = $user_id;
            $reply->modified = $this->created;
            $reply->save();
        }
    }

    function showNotice($include_user = true) {
        $profile = $this->user;
        $twitter_status = array();
        $twitter_status['text'] = $this->content;
        $twitter_status['truncated'] = false; # Not possible on StatusNet
        $twitter_status['created_at'] = $this->dateTwitter($this->created);
        $twitter_status['in_reply_to_status_id'] = ($this->reply_to) ? intval($this->reply_to) : null;
        $twitter_status['source'] = $this->source;
        $twitter_status['id'] = intval($this->id);

        $replier_profile = null;

        if ($this->reply_to) {
            $reply = self::model()->findByPk($this->reply_to);
            if ($reply) {
                $replier_profile = $reply->user_id;
            }
        }

        $twitter_status['in_reply_to_user_id'] =
                ($replier_profile) ? intval($replier_profile) : null;
        $twitter_status['in_reply_to_screen_name'] =
                ($replier_profile) ? $reply->user->username : null;

        if (isset($this->lat) && isset($this->lon)) {
            // This is the format that GeoJSON expects stuff to be in
            $twitter_status['geo'] = array('type' => 'Point',
                'coordinates' => array((float) $this->lat,
                    (float) $this->lon));
        } else {
            $twitter_status['geo'] = null;
        }

        if (isset($this->user)) {
            $twitter_status['favorited'] = $this->user->hasFave($this);
        } else {
            $twitter_status['favorited'] = false;
        }

        // Enclosures
        // 关于在微博中上传附件的问题，以后再处理，先放着
//        $attachments = $this->url;
//
//        if (!empty($attachments)) {
//
//            $twitter_status['attachments'] = array();
//
//            foreach ($attachments as $attachment) {
//                $enclosure_o = $attachment->getEnclosure();
//                if ($enclosure_o) {
//                    $enclosure = array();
//                    $enclosure['url'] = $enclosure_o->url;
//                    $enclosure['mimetype'] = $enclosure_o->mimetype;
//                    $enclosure['size'] = $enclosure_o->size;
//                    $twitter_status['attachments'][] = $enclosure;
//                }
//            }
//        }

        if ($include_user && $profile) {
            // Don't get notice (recursive!)
            $twitter_user = Notice::twitterUserArray($profile, false);
            $twitter_status['user'] = $twitter_user;
        }

        // StatusNet-specific

        $twitter_status['statusnet_html'] = $this->rendered;
        $twitter_status['statusnet_conversation_id'] = intval($this->conversation);

        return $twitter_status;
    }

    public static function twitterUserArray($user, $get_notice = false) {
        $twitter_user = array();
        $twitter_user['id'] = intval($user->id);
        $twitter_user['name'] = $user->profile->getBestName();
        $twitter_user['screen_name'] = $user->profile->nickname;
        //$twitter_user['location'] = ($profile->location) ? $profile->location : null;
        //  $twitter_user['description'] = ($profile->bio) ? $profile->bio : null;
        $twitter_user['description'] = null;
        $twitter_user['location'] = null;
        $twitter_user['profile_image_url'] = $user->profile->photo_path; //width: 48
        $twitter_user['url'] = null; //$profile->homepage
        $twitter_user['protected'] = false;
        // $twitter_user['followers_count'] = $user->profile->subscriberCount();
        $twitter_user['followers_count'] = 0;

        // Note: some profiles don't have an associated user
        // $twitter_user['friends_count'] = $profile->subscriptionCount();
        $twitter_user['friends_count'] = 0;
        $twitter_user['created_at'] = Notice::dateTwitter($user->create_at);

        $twitter_user['favourites_count'] = $user->faveCount();

        $timezone = 'UTC';

//        if (!empty($user) && $user->timezone) {
//            $timezone = $user->timezone;
//        }

        $t = new DateTime;
        $t->setTimezone(new DateTimeZone($timezone));

        $twitter_user['utc_offset'] = $t->format('Z');
        $twitter_user['time_zone'] = $timezone;
        $twitter_user['statuses_count'] = $user->noticeCount();

        // Is the requesting user following this user?
//        $twitter_user['following'] = false;
        $twitter_user['following'] = true;
        $twitter_user['statusnet_blocking'] = false;
        $twitter_user['notifications'] = false;
//先不考虑订阅情况
//        if (isset($this->user)) {
//
//            $twitter_user['following'] = $this->auth_user->isSubscribed($profile);
//            $twitter_user['statusnet_blocking'] = $this->auth_user->hasBlocked($profile);
//
//            // Notifications on?
//            $sub = Subscription::pkeyGet(array('subscriber' =>
//                        $this->auth_user->id,
//                        'subscribed' => $profile->id));
//
//            if ($sub) {
//                $twitter_user['notifications'] = ($sub->jabber || $sub->sms);
//            }
//        }
//        
        //account/VerifyCredentials用户验证的时候，返回用户信息并且带上最后一条微博信息
        if ($get_notice) {
            $notice = $user->getCurrentNotice();
            if ($notice) {
                // don't get user!
                $twitter_user['status'] = $notice->showNotice(false);
            }
        }
        // StatusNet-specific
//        $twitter_user['statusnet_profile_url'] = $profile->profileurl;// /user/admin/view/id/2
        $twitter_user['statusnet_profile_url'] = Yii::app()->baseUrl . 'index.php/user/admin/view/id/' . $user->id;

        return $twitter_user;
    }

    public static function dateTwitter($dt) {
        $dateStr = date('d F Y H:i:s', strtotime($dt));
        $d = new DateTime($dateStr, new DateTimeZone('UTC'));
        $d->setTimezone(new DateTimeZone('Asia/Shanghai'));
        return $d->format('D M d H:i:s O Y');
    }

    //返回array user_ids
    public static function common_find_mentions($text, $notice) {
        $sender = $notice->user;
        $user_ids = array();
        $nicknames = self::common_find_mentions_raw($text);
//        Yii::app()->end();
        foreach ($nicknames as $nickname) {
            //如果回复中的@是回复原帖作者，则不将原帖作者的id加入数组中
//            if ($sender->profile->nickname == $nickname) {
//                   echo '---++--';
//                continue;
//            }
            $profile = Profile::model()->find('nickname=:nickname', array(':nickname' => $nickname));
            // var_dump($profile);
            if ($profile) {
                $user_ids[] = $profile->user_id;
            }
        }
//        var_dump($user_ids);
//         Yii::app()->end();
        return $user_ids;
    }

    public static function normalize($str) {
        if (mb_strlen($str) > self::MAX_LEN) {
            // Display forms must also fit!
            throw new Exception();
        }

        $str = trim($str);
        $str = str_replace('_', '', $str);
        $str = mb_strtolower($str);

        if (mb_strlen($str) < 1) {
            throw new Exception();
        }
        if (!self::isCanonical($str)) {
            throw new Exception();
        }

        return $str;
    }

    /**
     * Is the given string a valid canonical nickname form?
     *
     * @param string $str
     * @return boolean
     */
    public static function isCanonical($str) {
        return preg_match('/^(?:' . self::CANONICAL_FMT . ')$/', $str);
    }

    //找到content中@过的用户nickname
    //返回array eg: [['snfang'],['xiaojing'],['镜头']
    public static function common_find_mentions_raw($text) {
        $mentions = array();
        $tmatches = array();
        preg_match_all('/^T (' . self::DISPLAY_FMT . ') /u', $text, $tmatches, PREG_OFFSET_CAPTURE);

        $atmatches = array();
        preg_match_all('/(?:^|\s+)@(' . self::DISPLAY_FMT . ')\b/u', $text, $atmatches, PREG_OFFSET_CAPTURE);

        $matches = array_merge($tmatches[1], $atmatches[1]);
        foreach ($matches as $m) {
            $mentions[] = $m[0];
        }
        return $mentions;
    }

}

