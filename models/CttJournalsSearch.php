<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CttJournals;

/**
 * CttJournalsSearch represents the model behind the search form about `app\models\CttJournals`.
 */
class CttJournalsSearch extends CttJournals
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'source_type_id', 'volume_per_year', 'issue_per_volume', 'history_indication_id', 'country_id', 'publisher_id', 'organization_id'], 'integer'],
            [['lang', 'alias_id', 'name', 'name_fulltext', 'abbrev_name', 'issn', 'eissn', 'isbn', 'coverage', 'editor', 'open_status', 'access_status', 'source_type', 'print_lang', 'history_indication', 'address', 'phone', 'fax', 'email', 'website', 'subjectarea_class', 'organization', 'status', 'created_by', 'created_dtm', 'modified_by', 'modified_dtm'], 'safe'],
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
        $query = CttJournals::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        Yii::trace(print_r($this,true), 'debug');

        // Conditions for filter
        $query->where('lang_id = (select min(lang_id)
                        from ctt_journals t2
                        where t2.id = ctt_journals.id
                        and t2.name like :name
                        group by id)',
                        [
                            ':name' => ($this->name)? '%'.$this->name.'%': '%%',
                        ]);

        $query->andFilterWhere([
            'id' => $this->id,
            'lang_id' => $this->lang_id,
            'source_type_id' => $this->source_type_id,
            'volume_per_year' => $this->volume_per_year,
            'issue_per_volume' => $this->issue_per_volume,
            'history_indication_id' => $this->history_indication_id,
            'country_id' => $this->country_id,
            'publisher_id' => $this->publisher_id,
            'organization_id' => $this->organization_id,
            'publisher_id' => $this->publisher_id,
            'created_dtm' => $this->created_dtm,
            'modified_dtm' => $this->modified_dtm,
        ]);

        // $query->andFilterWhere(['like', 'lang', $this->lang])
        //     ->andFilterWhere(['like', 'alias_id', $this->alias_id])
        //     ->andFilterWhere(['like', 'name', $this->name])
        //     ->andFilterWhere(['like', 'name_fulltext', $this->name_fulltext])
        //     ->andFilterWhere(['like', 'abbrev_name', $this->abbrev_name])
        //     ->andFilterWhere(['like', 'issn', $this->issn])
        //     ->andFilterWhere(['like', 'eissn', $this->eissn])
        //     ->andFilterWhere(['like', 'isbn', $this->isbn])
        //     ->andFilterWhere(['like', 'coverage', $this->coverage])
        //     ->andFilterWhere(['like', 'editor', $this->editor])
        //     ->andFilterWhere(['like', 'open_status', $this->open_status])
        //     ->andFilterWhere(['like', 'access_status', $this->access_status])
        //     ->andFilterWhere(['like', 'source_type', $this->source_type])
        //     ->andFilterWhere(['like', 'print_lang', $this->print_lang])
        //     ->andFilterWhere(['like', 'history_indication', $this->history_indication])
        //     ->andFilterWhere(['like', 'address', $this->address])
        //     ->andFilterWhere(['like', 'phone', $this->phone])
        //     ->andFilterWhere(['like', 'fax', $this->fax])
        //     ->andFilterWhere(['like', 'email', $this->email])
        //     ->andFilterWhere(['like', 'website', $this->website])
        //     ->andFilterWhere(['like', 'subjectarea_class', $this->subjectarea_class])
        //     ->andFilterWhere(['like', 'organization', $this->organization])
        //     ->andFilterWhere(['like', 'status', $this->status])
        //     ->andFilterWhere(['like', 'created_by', $this->created_by])
        //     ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }
}
