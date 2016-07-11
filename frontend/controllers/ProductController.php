<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use common\models\Product;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\filters\ContentNegotiator;
use common\models\Comment;
use yii\helpers\Html;

class ProductController extends Controller
{
    public function behaviors() {
        return [
            [
                'class' => ContentNegotiator::className(),
                'only' => ['add-comment'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionView($id) {
        $product = $this->getModel($id);
        return $this->render('view', compact('product'));
    }

    public function actionAddComment() {
        $productId = Yii::$app->request->post('productId');
        $rank = Yii::$app->request->post('rank');
        $content = Yii::$app->request->post('content');

        $comment = new Comment();
        $comment->attributes = [
            'product_id' => $productId,
            'user_id' => Yii::$app->user->identity->id,
            'rank' => $rank,
            'content' => $content,
        ];
        if ($comment->save(true)) {
            return [
                'status' => true,
                'message' => '成功',
            ];
        } else {
            return [
                'status' => false,
                'message' => '失败: ' . Html::errorSummary($comment),
            ];
        }
    }

    public function getModel($id) {
        $product = Product::findOne($id);
        if (!$product) {
            throw new NotFoundHttpException(Yii::t('app', 'specify product could not be found.'));
        } else {
            return $product;
        }
    }
}
