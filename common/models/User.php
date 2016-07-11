<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class User extends \common\components\ActiveRecord implements IdentityInterface
{
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'username', 'auth_key', 'password_hash'], 'required'],
            [['status'], 'integer'],
            [['email', 'auth_key'], 'string', 'max' => 32],
            [['username'], 'string', 'max' => 16],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public static function findByEmail($email) {
        return static::findOne(['email' => $email]);
    }

    public static function findIdentity($email) {
        return static::findByEmail($email);
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
}
