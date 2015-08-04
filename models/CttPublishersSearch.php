<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CttPublishers;

/**
 * CttPublishersSearch represents the model behind the search form about `app\models\CttPublishers`.
 */
class CttPublishersSearch extends CttPublishers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'country_id'], 'integer'],
            [['lang', 'aliasid', 'name', 'main_publisher', 'address', 'country', 'phone', 'website', 'email', 'created_by', 'created_dtm', 'modified_by', 'modified_dtm'], 'safe'],
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
        $query = CttPublishers::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // Conditions for filter
        $query->where('lang_id = (select min(lang_id)
                        from ctt_publishers t2
                        where t2.id = ctt_publishers.id
                        and t2.name like :name
                        group by id)',
                        [
                            ':name' => ($this->name)? '%'.$this->name.'%': '%%',
                        ]);

        $query->andFilterWhere([
            'id' => $this->id,
            'lang_id' => $this->lang_id,
            'country_id' => $this->country_id,
            'created_dtm' => $this->created_dtm,
            'modified_dtm' => $this->modified_dtm,
        ]);

        // $query->andFilterWhere(['like', 'lang', $this->lang])
        //     ->andFilterWhere(['like', 'aliasid', $this->aliasid])
        //     ->andFilterWhere(['like', 'name', $this->name])
        //     ->andFilterWhere(['like', 'main_publisher', $this->main_publisher])
        //     ->andFilterWhere(['like', 'editor', $this->editor])
        //     ->andFilterWhere(['like', 'address', $this->address])
        //     ->andFilterWhere(['like', 'country', $this->country])
        //     ->andFilterWhere(['like', 'phone', $this->phone])
        //     ->andFilterWhere(['like', 'website', $this->website])
        //     ->andFilterWhere(['like', 'email', $this->email])
        //     ->andFilterWhere(['like', 'created_by', $this->created_by])
        //     ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }
}
