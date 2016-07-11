<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\ProductCategory;
use backend\models\ProductCategorySearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class ProductCategoryController extends Controller {
    public function behaviors() {
        return [
            [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'delete-multiple'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex() {
        $filterModel = new ProductCategorySearch();
        $dataProvider = $filterModel->search(Yii::$app->request->queryParams);
        return $this->render('index', compact('dataProvider', 'filterModel'));
    }
    
    public function actionView($id) {
        $model = $this->findModel($id);
        return $this->render('view', compact('model'));
    }
    
    public function actionCreate() {
        $model = new ProductCategory();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['product-category/view', 'id' => $model->id]);
        }
        return $this->render('create', compact('model'));
    }
    
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['product-category/view', 'id' => $model->id]);
        }
        return $this->render('update', compact('model'));
    }
    
    public function actionDelete($id) {
        $this->findModel($id)->softDelete($id);
        return $this->redirect('index');
    }
    
    public function actionDeleteMultiple() {
        foreach(ArrayHelper::getValue(Yii::$app->request->post(), 'ids', []) as $id) {
            $this->findModel($id)->softDelete();
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
    
    protected function findModel($id) {
        if ($model = ProductCategory::findOne($id)) {
            return $model;
        } else {
            throw new NotFoundHttpException();
        }
    }
}
