<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctt_articles".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property string $lang
 * @property integer $documenttype_id
 * @property string $documenttype
 * @property integer $docsource_id
 * @property string $docsource
 * @property string $alias_id
 * @property string $title
 * @property string $abbrev_title
 * @property string $title_fulltext
 * @property integer $publisher_id
 * @property integer $journal_id
 * @property string $journal
 * @property integer $issue_id
 * @property integer $year
 * @property string $volume
 * @property string $artnumber
 * @property string $page_start
 * @property string $page_end
 * @property integer $page_count
 * @property integer $cited
 * @property string $doi
 * @property string $link
 * @property integer $organization_id
 * @property string $organization
 * @property string $abstract
 * @property string $abstract_fulltext
 * @property string $author_keyword
 * @property string $auto_keyword
 * @property string $authors
 * @property string $funding
 * @property string $correspondence
 * @property string $sponsors
 * @property string $codenid
 * @property string $pubmedid
 * @property string $checksum
 * @property string $subjectarea_class
 * @property string $status
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttArticleAuthors[] $cttArticleAuthors
 * @property CttArticleReferences[] $cttArticleReferences
 * @property CttArticleRevs[] $cttArticleRevs
 * @property CttArticleSubjectareaclass[] $cttArticleSubjectareaclasses
 * @property CttIssues $issue
 * @property CttJournals $journal0
 * @property CttPublishers $publisher
 * @property CttStaticdataDocsources $docsource0
 * @property CttStaticdataDocumenttypes $documenttype0
 * @property CttStaticdataOrganizations $organization0
 */
class CttArticles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctt_articles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'documenttype_id', 'title', 'journal_id', 'issue_id'], 'required'],
            [['id', 'lang_id', 'documenttype_id', 'docsource_id', 'publisher_id', 'journal_id', 'issue_id', 'year', 'page_count', 'cited', 'organization_id'], 'integer'],
            [['title', 'title_fulltext', 'abstract', 'abstract_fulltext', 'author_keyword', 'auto_keyword', 'authors'], 'string'],
            [['created_dtm', 'modified_dtm'], 'safe'],
            [['lang', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['documenttype', 'abbrev_title', 'subjectarea_class'], 'string', 'max' => 100],
            [['docsource', 'alias_id', 'artnumber', 'doi', 'codenid', 'pubmedid'], 'string', 'max' => 50],
            [['journal', 'link', 'organization', 'funding', 'correspondence', 'sponsors'], 'string', 'max' => 200],
            [['volume', 'page_start', 'page_end'], 'string', 'max' => 10],
            [['checksum'], 'string', 'max' => 40],
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
            'lang_id' => Yii::t('app', 'Lang ID'),
            'lang' => Yii::t('app', 'Lang'),
            'documenttype_id' => Yii::t('app', 'Documenttype ID'),
            'documenttype' => Yii::t('app', 'Documenttype'),
            'docsource_id' => Yii::t('app', 'Docsource ID'),
            'docsource' => Yii::t('app', 'Docsource'),
            'alias_id' => Yii::t('app', 'Alias ID'),
            'title' => Yii::t('app', 'Title'),
            'abbrev_title' => Yii::t('app', 'Abbrev Title'),
            'title_fulltext' => Yii::t('app', 'Title Fulltext'),
            'publisher_id' => Yii::t('app', 'Publisher ID'),
            'journal_id' => Yii::t('app', 'Journal ID'),
            'journal' => Yii::t('app', 'Journal'),
            'issue_id' => Yii::t('app', 'Issue ID'),
            'year' => Yii::t('app', 'Year'),
            'volume' => Yii::t('app', 'Volume'),
            'artnumber' => Yii::t('app', 'Artnumber'),
            'page_start' => Yii::t('app', 'Page Start'),
            'page_end' => Yii::t('app', 'Page End'),
            'page_count' => Yii::t('app', 'Page Count'),
            'cited' => Yii::t('app', 'Cited'),
            'doi' => Yii::t('app', 'Doi'),
            'link' => Yii::t('app', 'Link'),
            'organization_id' => Yii::t('app', 'Organization ID'),
            'organization' => Yii::t('app', 'Organization'),
            'abstract' => Yii::t('app', 'Abstract'),
            'abstract_fulltext' => Yii::t('app', 'Abstract Fulltext'),
            'author_keyword' => Yii::t('app', 'Author Keyword'),
            'auto_keyword' => Yii::t('app', 'Auto Keyword'),
            'authors' => Yii::t('app', 'Authors'),
            'funding' => Yii::t('app', 'Funding'),
            'correspondence' => Yii::t('app', 'Correspondence'),
            'sponsors' => Yii::t('app', 'Sponsors'),
            'codenid' => Yii::t('app', 'Codenid'),
            'pubmedid' => Yii::t('app', 'Pubmedid'),
            'checksum' => Yii::t('app', 'Checksum'),
            'subjectarea_class' => Yii::t('app', 'Subjectarea Class'),
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
    public function getCttArticleAuthors()
    {
        return $this->hasMany(CttArticleAuthors::className(), ['article_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttArticleReferences()
    {
        return $this->hasMany(CttArticleReferences::className(), ['article_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttArticleRevs()
    {
        return $this->hasMany(CttArticleRevs::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttArticleSubjectareaclasses()
    {
        return $this->hasMany(CttArticleSubjectareaclass::className(), ['article_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIssue()
    {
        return $this->hasOne(CttIssues::className(), ['id' => 'issue_id']);
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
    public function getPublisher()
    {
        return $this->hasOne(CttPublishers::className(), ['id' => 'publisher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocsource0()
    {
        return $this->hasOne(CttStaticdataDocsources::className(), ['id' => 'docsource_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumenttype0()
    {
        return $this->hasOne(CttStaticdataDocumenttypes::className(), ['id' => 'documenttype_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization0()
    {
        return $this->hasOne(CttStaticdataOrganizations::className(), ['id' => 'organization_id']);
    }

    public function getId() 
    {
        $id = '';
        $data = parent::find()->where(['name' => $this->name])->one();

        if (empty($data)) {
            $id = CttSequences::getValue('ARTICLE_SEQ');
        } else {
           $id = $data->id;
        }

        return $id;
    }
}
