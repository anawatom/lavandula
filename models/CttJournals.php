<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctt_journals".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property string $lang
 * @property string $alias_id
 * @property string $name
 * @property string $name_fulltext
 * @property string $abbrev_name
 * @property string $issn
 * @property string $eissn
 * @property string $isbn
 * @property string $coverage
 * @property string $editor
 * @property string $open_status
 * @property string $access_status
 * @property integer $source_type_id
 * @property string $source_type
 * @property string $print_lang
 * @property integer $volume_per_year
 * @property integer $issue_per_volume
 * @property integer $history_indication_id
 * @property string $history_indication
 * @property string $address
 * @property integer $country_id
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $website
 * @property integer $publisher_id
 * @property string $subjectarea_class
 * @property integer $organization_id
 * @property string $organization
 * @property string $status
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttArticleReferences[] $cttArticleReferences
 * @property CttArticles[] $cttArticles
 * @property CttIssues[] $cttIssues
 * @property CttJournalRevs[] $cttJournalRevs
 * @property CttJournalSubjectareaclass[] $cttJournalSubjectareaclasses
 * @property CttPublishers $publisher
 * @property CttStaticdataHistoryindications $historyIndication
 * @property CttStaticdataOrganizations $organization0
 * @property CttStaticdataSourcetypes $sourceType
 */
class CttJournals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctt_journals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'name', 'open_status', 'source_type_id', 'publisher_id'], 'required'],
            [['id', 'lang_id', 'source_type_id', 'volume_per_year', 'issue_per_volume', 'history_indication_id', 'country_id', 'publisher_id', 'organization_id'], 'integer'],
            [['name_fulltext'], 'string'],
            [['created_dtm', 'modified_dtm'], 'safe'],
            [['lang', 'issn', 'eissn', 'isbn', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['alias_id', 'access_status', 'print_lang', 'phone', 'fax'], 'string', 'max' => 100],
            [['name', 'coverage', 'editor', 'email', 'website', 'organization'], 'string', 'max' => 200],
            [['abbrev_name', 'source_type', 'history_indication'], 'string', 'max' => 50],
            [['open_status', 'status'], 'string', 'max' => 1],
            [['address', 'subjectarea_class'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lang_id' => Yii::t('app', 'Lang ID'),
            'lang' => Yii::t('app', 'Lang'),
            'alias_id' => Yii::t('app', 'Alias ID'),
            'name' => Yii::t('app', 'Name'),
            'name_fulltext' => Yii::t('app', 'Name Fulltext'),
            'abbrev_name' => Yii::t('app', 'Abbrev Name'),
            'issn' => Yii::t('app', 'Issn'),
            'eissn' => Yii::t('app', 'Eissn'),
            'isbn' => Yii::t('app', 'Isbn'),
            'coverage' => Yii::t('app', 'Coverage'),
            'editor' => Yii::t('app', 'Editor'),
            'open_status' => Yii::t('app', 'Open Status'),
            'access_status' => Yii::t('app', 'Access Status'),
            'source_type_id' => Yii::t('app', 'Source Type ID'),
            'source_type' => Yii::t('app', 'Source Type'),
            'print_lang' => Yii::t('app', 'Print Lang'),
            'volume_per_year' => Yii::t('app', 'Volume Per Year'),
            'issue_per_volume' => Yii::t('app', 'Issue Per Volume'),
            'history_indication_id' => Yii::t('app', 'History Indication ID'),
            'history_indication' => Yii::t('app', 'History Indication'),
            'address' => Yii::t('app', 'Address'),
            'country_id' => Yii::t('app', 'Country ID'),
            'phone' => Yii::t('app', 'Phone'),
            'fax' => Yii::t('app', 'Fax'),
            'email' => Yii::t('app', 'Email'),
            'website' => Yii::t('app', 'Website'),
            'publisher_id' => Yii::t('app', 'Publisher ID'),
            'subjectarea_class' => Yii::t('app', 'Subjectarea Class'),
            'organization_id' => Yii::t('app', 'Organization ID'),
            'organization' => Yii::t('app', 'Organization'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_dtm' => Yii::t('app', 'Created Dtm'),
            'modified_by' => Yii::t('app', 'Modified By'),
            'modified_dtm' => Yii::t('app', 'Modified Dtm'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttArticleReferences()
    {
        return $this->hasMany(CttArticleReferences::className(), ['journal_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttArticles()
    {
        return $this->hasMany(CttArticles::className(), ['journal_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttIssues()
    {
        return $this->hasMany(CttIssues::className(), ['journal_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttJournalRevs()
    {
        return $this->hasMany(CttJournalRevs::className(), ['journal_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttJournalSubjectareaclasses()
    {
        return $this->hasMany(CttJournalSubjectareaclass::className(), ['journal_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisher()
    {
        return $this->hasOne(CttPublishers::className(), ['id' => 'publisher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoryIndication()
    {
        return $this->hasOne(CttStaticdataHistoryindications::className(), ['id' => 'history_indication_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization0()
    {
        return $this->hasOne(CttStaticdataOrganizations::className(), ['id' => 'organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSourceType()
    {
        return $this->hasOne(CttStaticdataSourcetypes::className(), ['id' => 'source_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(CttStaticdataCountrys::className(), ['id' => 'country_id']);
    }
}
