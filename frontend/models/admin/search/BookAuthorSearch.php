<?php

namespace frontend\models\admin\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\BookAuthor;

class BookAuthorSearch extends BookAuthor
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['book_id', 'author_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios(): array
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
    public function search(array $params): ActiveDataProvider
    {
        $query = BookAuthor::find()->with(['book', 'author']);

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
            'book_id' => $this->book_id,
            'author_id' => $this->author_id,
        ]);

        return $dataProvider;
    }

}