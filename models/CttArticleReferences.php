<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctt_article_references".
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $ref_article_id
 * @property string $subjectarea_class
 * @property string $doi
 * @property integer $journal_id
 * @property string $journal
 * @property string $month
 * @property integer $year
 * @property string $issue_no
 * @property string $year_no
 * @property string $page_no
 * @property string $topic
 * @property string $authors
 * @property string $status
 * @property string $other
 * @property integer $reference_type
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttArticles $article
 * @property CttJournals $journal0
 * @property CttArticlereferenceSubjectareaclass[] $cttArticlereferenceSubjectareaclasses
 * @property CttReferenceAuthors[] $cttReferenceAuthors
 */
class CttArticleReferences extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctt_article_references';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'topic'], 'required'],
            [['article_id', 'ref_article_id', 'journal_id', 'year', 'reference_type'], 'integer'],
            [['topic', 'authors', 'other'], 'string'],
            [['created_dtm', 'modified_dtm'], 'safe'],
            [['subjectarea_class'], 'string', 'max' => 100],
            [['doi'], 'string', 'max' => 50],
            [['journal'], 'string', 'max' => 200],
            [['month'], 'string', 'max' => 10],
            [['issue_no', 'page_no', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['year_no'], 'string', 'max' => 4],
            [['status'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'article_id' => Yii::t('app', 'Article ID'),
            'ref_article_id' => Yii::t('app', 'Ref Article ID'),
            'subjectarea_class' => Yii::t('app', 'Subjectarea Class'),
            'doi' => Yii::t('app', 'Doi'),
            'journal_id' => Yii::t('app', 'Journal ID'),
            'journal' => Yii::t('app', 'Journal'),
            'month' => Yii::t('app', 'Month'),
            'year' => Yii::t('app', 'Year'),
            'issue_no' => Yii::t('app', 'Issue No'),
            'year_no' => Yii::t('app', 'Year No'),
            'page_no' => Yii::t('app', 'Page No'),
            'topic' => Yii::t('app', 'Topic'),
            'authors' => Yii::t('app', 'Authors'),
            'status' => Yii::t('app', 'Status'),
            'other' => Yii::t('app', 'Other'),
            'reference_type' => Yii::t('app', 'Reference Type'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_dtm' => Yii::t('app', 'Created Dtm'),
            'modified_by' => Yii::t('app', 'Modified By'),
            'modified_dtm' => Yii::t('app', 'Modified Dtm'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(CttArticles::className(), ['id' => 'article_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournal0()
    {
        return $this->hasOne(CttJournals::className(), ['id' => 'journal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttArticlereferenceSubjectareaclasses()
    {
        return $this->hasMany(CttArticlereferenceSubjectareaclass::className(), ['articlereference_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttReferenceAuthors()
    {
        return $this->hasMany(CttReferenceAuthors::className(), ['articlereference_id' => 'id']);
    }
}
