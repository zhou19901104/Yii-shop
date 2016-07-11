<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ProductSearch;

class ProductSearchForm extends Model
{
    public function rules() {
        return [

        ];
    }

    public function search($keyword) {
        $db = ProductSearch::getDb();
        $search = $db->getSearch();
        $search->setQuery($keyword);
        $search->setFacets(['category_id']);
        $search->search();
        $categoryIdSum = $search->getFacets('category_id');
        arsort($categoryIdSum);
        $categoryId = key($categoryIdSum);

        $query = ProductSearch::find();
        $query->where(['AND', $keyword, sprintf('category_id:%s', $categoryId)]);

        $dp = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 1,
            ],
        ]);

        return $dp;
    }
}
