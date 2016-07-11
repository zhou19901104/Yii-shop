<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use common\models\User;

/**
 * This is the model class for table "{{%product_order}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $address
 * @property integer $paid_time
 * @property string $total_price
 * @property string $contact
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property integer $payment
 * @property integer $shipment
 */
class ProductOrder extends \common\components\ActiveRecord
{
    const STATUS_CREATED = 1;
    const STATUS_PAID = 2;
    const STATUS_DELIVERY = 3;
    const STATUS_SUCCESS = 4;
    const STATUS_REFOUND = 5;

    public static $paymentList = [
		1 => '货到付款',
		2 => '在线支付',
		3 => '上门自提',
		4 => '邮局汇款',
    ];

	public static $shipmentList = [
        1 => '普通快递送货上门',
        2 => '特快专递',
        3 => '加急快递送货上门',
        4 => '平邮',
	];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_order}}';
    }

    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
            TimestampBehavior::className(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'address', 'total_price', 'contact', 'payment', 'shipment'], 'required'],
            [['user_id', 'paid_time', 'status', 'payment', 'shipment'], 'integer'],
            [['total_price'], 'number'],
            [['address'], 'string', 'max' => 200],
            [['out_order_no', 'charge_id'], 'string', 'max' => 256],
            [['contact'], 'string', 'max' => 20],
            ['status', 'default', 'value' => self::STATUS_CREATED],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'address' => Yii::t('app', 'Address'),
            'paid_time' => Yii::t('app', 'Paid Time'),
            'total_price' => Yii::t('app', 'Total Price'),
            'contact' => Yii::t('app', 'Contact'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
            'payment' => Yii::t('app', 'Payment'),
            'shipment' => Yii::t('app', 'Shipment'),
            'out_order_no' => Yii::t('app', 'Out Order No'),
            'charge_id' => Yii::t('app', 'Charge Id'),
        ];
    }

    public function getPayAmount() {
        return $this->total_price * 100;
    }

    public function tryPaid() {
        $chargeInfo = Yii::$app->pingpp->retrieve($this->charge_id);
        if (!$chargeInfo) {
            throw new NotFoundHttpException(Yii::t('app', 'specify product order charge could not be found.'));
        }
        if ($chargeInfo->paid) {
            $this->status = self::STATUS_PAID;
            return $this->save();
        } else {
            return false;
        }
    }

    public static function getStatusLabels() {
        return ArrayHelper::merge(parent::getStatusLabels(), [
            self::STATUS_CREATED => '已创建',
            self::STATUS_PAID => '已支付',
            self::STATUS_DELIVERY => '已发货',
            self::STATUS_SUCCESS => '已完成',
            self::STATUS_SUCCESS => '已退款',
        ]);
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getPaymentLabel() {
        return ArrayHelper::getValue(self::$paymentList, $this->payment);
    }

    public function getShipmentLabel() {
        return ArrayHelper::getValue(self::$shipmentList, $this->shipment);
    }
}
