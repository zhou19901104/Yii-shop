<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form about `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'inventory', 'promotion_start_time', 'promotion_end_time', 'is_new', 'is_hot', 'is_best', 'display_order', 'score', 'created_at', 'updated_at', 'status'], 'integer'],
            [['name', 'description', 'logo'], 'safe'],
            [['our_price', 'market_price', 'promotion_price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'inventory' => $this->inventory,
            'our_price' => $this->our_price,
            'market_price' => $this->market_price,
            'promotion_price' => $this->promotion_price,
            'promotion_start_time' => $this->promotion_start_time,
            'promotion_end_time' => $this->promotion_end_time,
            'is_new' => $this->is_new,
            'is_hot' => $this->is_hot,
            'is_best' => $this->is_best,
            'display_order' => $this->display_order,
            'score' => $this->score,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'logo', $this->logo]);

        return $dataProvider;
    }
}
