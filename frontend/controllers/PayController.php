<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use common\components\Controller;
use common\models\ProductOrder;
use yii\web\NotFoundHttpException;
use idarex\pingppyii2\Channel;
use idarex\pingppyii2\ChargeForm;
use yii\web\ServerErrorHttpException;;
use yii\web\Response;

class PayController extends Controller {
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'only' => ['create'],  // in a controller
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionCreate() {
        $productOrder = $this->getModel(Yii::$app->request->post('orderId'));

        $chargeForm = new ChargeForm();
        $chargeForm->order_no = $productOrder->id;
        $chargeForm->amount = $productOrder->payAmount;
        /**
         * @see Channel
         */
        $chargeForm->channel = Channel::ALIPAY_PC_DIRECT;
        $chargeForm->currency = 'cny';
        $chargeForm->client_ip = Yii::$app->getRequest()->userIP;
        $chargeForm->subject = sprintf("为订单ID为#%s的订单付款。", $productOrder->id);
        $chargeForm->body = sprintf('订单总价为 %s, 联系方式为 %s, 联系地址为 %s', $productOrder->total_price, $productOrder->contact, $productOrder->address);
        $chargeForm->extra = [
            'success_url' => Url::to(['success-sync-callback'], true),
        ];
        
        if ($response = $chargeForm->create()) {
            $productOrder->out_order_no = $response->order_no;
            $productOrder->charge_id = $response->id;
            if($productOrder->save()) {
                return $response->__toArray(true);
            }
        } elseif ($chargeForm->hasErrors()) {
            return $chargeForm->getErrors();
        }
        throw new ServerErrorHttpException();
    }

    public function actionSuccessSyncCallback($out_trade_no) {
        $productOrder = ProductOrder::findOne(['out_order_no' => $out_trade_no, 'user_id' => Yii::$app->user->identity->id]);
        if (!$productOrder) {
            throw new NotFoundHttpException(Yii::t('app', 'specify product order could not be found.'));
        }
        $productOrder->tryPaid();
        return $this->goHome();
    }

    public function getModel($id) {
        $productOrder = ProductOrder::findOne(['id' => $id, 'user_id' => Yii::$app->user->identity->id]);
        if (!$productOrder) {
            throw new NotFoundHttpException(Yii::t('app', 'specify product order could not be found.'));
        } else {
            return $productOrder;
        }
    }
}
