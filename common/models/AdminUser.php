<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use Identicon\Identicon;
use Zhuzhichao\IpLocationZh\Ip;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

class AdminUser extends ActiveRecord implements IdentityInterface {
    const STATUS_VALID = 1;
    const STATUS_INVALID = 0;

    protected $_avatar;
    protected $_ipLocation;

    public static function tableName() {
        return '{{%admin_user}}';
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function rules() {
        return [
            ['status', 'default', 'value' => self::STATUS_VALID],
            [['email', 'username', 'password_hash', 'status'], 'required'],
            ['email', 'unique', 'targetClass' => static::className(), 'targetAttribute' => 'email'],
            ['username', 'unique', 'targetClass' => static::className(), 'targetAttribute' => 'username'],
            [['created_at', 'updated_at'], 'number', 'integerOnly' => true],
            [['auth_key', 'password_hash'], 'string'],
        ];
    }

    public static function findIdentity($email) {
        return static::findOne(['email' => $email]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['auth_key' => $token]);
    }

    public function getId() {
        return $this->email;
    }

    public function getAuthKey() {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey) {
        return $this->auth_key === $authKey;
    }

    public static function findByEmail($email) {
        return static::findOne(['email' => $email]);
    }

    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function getAvatar() {
        if (!isset($this->_avatar)) {
            $this->_avatar = (new Identicon())->getImageDataUri($this->email);
        }
        return $this->_avatar;
    }

    public function getIpLocation() {
        if (!isset($this->_ipLocation)) {
            $locations = Ip::find(Yii::$app->request->userIp);
            $this->_ipLocation = trim($locations[1] . ' ' . $locations[2]);
        }
        return $this->_ipLocation;
    }
}