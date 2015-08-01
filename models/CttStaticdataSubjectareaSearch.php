<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CttStaticdataSubjectarea;

/**
 * CttStaticdataSubjectareaSearch represents the model behind the search form about `app\models\CttStaticdataSubjectarea`.
 */
class CttStaticdataSubjectareaSearch extends CttStaticdataSubjectarea
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id'], 'integer'],
            [['lang', 'name', 'status', 'created_by', 'created_dtm', 'modified_by', 'modified_dtm'], 'safe'],
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
        $query = CttStaticdataSubjectarea::find();

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
                        from ctt_staticdata_subjectarea t2
                        where t2.id = ctt_staticdata_subjectarea.id
                        and t2.name like :name
                        group by id)',
                        [
                            ':name' => ($this->name)? '%'.$this->name.'%': '%%',
                        ]);

        $query->andFilterWhere([
            'id' => $this->id,
            'lang_id' => $this->lang_id,
            'created_dtm' => $this->created_dtm,
            'modified_dtm' => $this->modified_dtm,
        ]);

        // $query->andFilterWhere(['like', 'lang', $this->lang])
        //     ->andFilterWhere(['like', 'name', $this->name])
        //     ->andFilterWhere(['like', 'status', $this->status])
        //     ->andFilterWhere(['like', 'created_by', $this->created_by])
        //     ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }

     /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchLangList($params)
    {
        $whereClause = [];
        if (empty($params['id'])) {
            $whereClause = ['id' => '-1'];
        } else {
            $whereClause = ['id' => $params['id']];
        }

        $query = CttStaticdataSubjectarea::find()
                    ->where($whereClause)
                    ->orderBy('lang_id');

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
            'lang_id' => $this->lang_id,
            'status' => $this->status,
            'created_dtm' => $this->created_dtm,
            'modified_dtm' => $this->modified_dtm,
        ]);

        // $query->andFilterWhere(['like', 'lang', $this->lang])
        //     ->andFilterWhere(['like', 'name', $this->name])
        //     ->andFilterWhere(['like', 'alias', $this->alias])
        //     ->andFilterWhere(['like', 'address', $this->address])
        //     ->andFilterWhere(['like', 'status', $this->status])
        //     ->andFilterWhere(['like', 'created_by', $this->created_by])
        //     ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }
}
