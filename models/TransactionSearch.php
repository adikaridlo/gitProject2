<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transaction;

/**
 * TransactionSearch represents the model behind the search form about `app\models\Transaction`.
 */
class TransactionSearch extends Transaction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'jurnal_no', 'customer_id', 'amount'], 'integer'],
            [['trans_name', 'type', 'currency', 'trans_date'], 'safe'],
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
        $query = Transaction::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'jurnal_no' => $this->jurnal_no,
            'customer_id' => $this->customer_id,
            'amount' => $this->amount,
            'trans_date' => $this->trans_date,
        ]);

        $query->andFilterWhere(['like', 'trans_name', $this->trans_name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'currency', $this->currency]);

        return $dataProvider;
    }
}
