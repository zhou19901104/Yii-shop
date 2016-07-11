<?php

namespace frontend\controllers;

use Yii;
use common\components\Controller;
use common\models\ProductInCart;
use common\models\ProductAttribute;
use yii\web\HttpException;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\filters\ContentNegotiator;

class CartController extends Controller {
    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
                'only' => ['add-to-cart', 'change-quantity', 'delete'],
            ],
        ]);
    }

    public function actionStep1() {
        return $this->render('step1');
    }

	public function actionAddToCart() {
		$productId = Yii::$app->request->post('productId', false);
        $quantity = abs((int) Yii::$app->request->post('quantity', false));

        $attributeAssignments = [];
        foreach(Yii::$app->request->post('attributeAssignments', []) as $attributeAssignment) {
            $attributeId = ArrayHelper::getValue($attributeAssignment, 'attributeId');
            $attributeOption = trim(ArrayHelper::getValue($attributeAssignment, 'attributeOption'));
            $productAttribute = ProductAttribute::findOne($attributeId);
            if (!$productAttribute->isValidOption($attributeOption)) {
                continue;
            }
            $attributeAssignments[] = [
                'attribute_id' => $attributeId,
                'attribute_option' => $attributeOption,
            ];
        }

		$productInCart = ProductInCart::findOne($productId);
        $productInCart->attributeAssignments = $attributeAssignments;
		if ($productInCart) {
			Yii::$app->cart->put($productInCart, $quantity);
			return ['status' => self::STATUS_SUCCESS, 'message' => Yii::t('app', 'Add Success.')];
        } else {
		    throw new HttpException(Yii::t('app', 'Please try again later.'));
        }
	}

    public function actionChangeQuantity() {
        $productInCart = $this->getModel(Yii::$app->request->post('productInCartId'));
        $operator = Yii::$app->request->post('operator');
        Yii::$app->cart->update($productInCart, ($operator == '+') ? $productInCart->quantity + 1 : $productInCart->quantity - 1);
        return [
            'status' => self::STATUS_SUCCESS,
            'data' => [
                'quantity' => $productInCart->quantity,
                'cost' => $productInCart->cost,
                'sumCost' => Yii::$app->cart->cost,
            ],
            'message' => Yii::t('app', 'modify success.'),
        ];
    }

    public function actionDelete() {
        $productInCart = $this->getModel(Yii::$app->request->post('productInCartId'));
        Yii::$app->cart->remove($productInCart);
        return [
            'status' => self::STATUS_SUCCESS,
            'data' => [
                'sumCost' => Yii::$app->cart->cost,
            ],
            'message' => Yii::t('app', 'delete success.'),
        ];
    }

    public function getModel($productInCartId) {
        $productInCart = Yii::$app->cart->getPositionById($productInCartId);
        if (!$productInCart) {
            throw new HttpException(Yii::t('app', 'Parameter error.'));
        }
        return $productInCart;
    }
}
