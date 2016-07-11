<?php

namespace backend\models;

use common\models\ProductCategory;
use yii\data\ActiveDataProvider;
use SORT_DESC;

class ProductCategorySearch extends ProductCategory {
    public function rules() {
        return [
            [['name', 'slug'], 'string'],
            [['name', 'slug'], 'trim'],
            [['id', 'status', 'parent_id'], 'integer'],
        ];
    }
    
    public function scenarios() {
        return parent::scenarios();
    }
    
    public function search($params) {
        $this->load($params);
        $query = static::softFind();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeLimit' => [1, 500],
            ],
        ]);
        
        //$query->orderBy(['updated_at' => SORT_DESC, 'display_order' => SORT_DESC]);
        if (!$this->validate()) {
            return $dataProvider;
        }
        
        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere([
            'or',
            ['like', 'name', $this->name],
            ['like', 'slug', $this->slug],
        ]);
        
        return $dataProvider;
    }
}
