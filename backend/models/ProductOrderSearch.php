<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductOrder;

/**
 * ProductOrderSearch represents the model behind the search form about `common\models\ProductOrder`.
 */
class ProductOrderSearch extends ProductOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'paid_time', 'created_at', 'updated_at', 'status', 'payment', 'shipment'], 'integer'],
            [['address', 'contact', 'out_order_no', 'charge_id'], 'safe'],
            [['total_price'], 'number'],
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
        $query = ProductOrder::find();

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
            'user_id' => $this->user_id,
            'paid_time' => $this->paid_time,
            'total_price' => $this->total_price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
            'payment' => $this->payment,
            'shipment' => $this->shipment,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'out_order_no', $this->out_order_no])
            ->andFilterWhere(['like', 'charge_id', $this->charge_id]);

        return $dataProvider;
    }
}
