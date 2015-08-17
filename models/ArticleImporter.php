<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\Exception;
use app\helpers\ErrorHelper;
use app\models\CttArticles;
use app\models\CttStaticdataLanguages;
use app\models\CttStaticdataReferences;
use app\models\CttStaticdataDocumenttypes;
use app\models\CttStaticdataDocsources;
use app\models\CttAuthors;
use app\models\CttJournals;
use app\models\CttIssues;
use app\models\CttArticleDocsources;

/**
 * ArticleImporter is the model behind the login form.
 */
class ArticleImporter extends Model
{
    public $id;
    public $lang_id;
    public $documenttype_id;
    public $docsource_id;
    public $title_en;
    public $abbrev_title_en;
    public $title_local;
    public $abbrev_title_local;
    public $author_keyword_en;
    public $author_keyword_local;
    public $abstract_en;
    public $abstract_local;
    public $authors;
    public $doi;
    public $link;
    public $funding;
    public $correspondence;
    public $sponsors;
    public $codenid;
    public $pubmedid;
    public $subjectarea_class;
    public $journal_id;
    public $issue_id;
    public $year;
    public $volume;
    public $year_no;
    public $artnumber;
    public $page_start;
    public $page_end;
    public $page_count;
    public $created_by;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        // return [
        //         [['lang_id',
        //         'documenttype_id',
        //         'docsource_id',
        //         'title_en',
        //         'abbrev_title_en',
        //         'title_local',
        //         'abbrev_title_local',
        //         'author_keyword_en',
        //         'author_keyword_local',
        //         'abstract_en',
        //         'abstract_local',
        //         'authors',
        //         'doi',
        //         'link',
        //         'funding',
        //         'correspondence',
        //         'sponsors',
        //         'codenid',
        //         'pubmedid',
        //         'subjectarea_class',
        //         'journal_id',
        //         'journal',
        //         'issue_id',
        //         'year',
        //         'volume',
        //         'year_no',
        //         'artnumber',
        //         'page_start',
        //         'page_end',
        //         'page_count'], 'integer'],
        // ];
        return [
                [['id',
                    'lang_id',
                    'documenttype_id',
                    'docsource_id',
                    'title_en',
                    'abbrev_title_en',
                    'author_keyword_en',
                    'abstract_en',
                    'title_local',
                    'journal_id',
                    'issue_id'], 'required'],
                [['id',
                    'lang_id',
                    'documenttype_id',
                    'docsource_id',
                    'journal_id',
                    'issue_id',
                    'year',
                    'volume',
                    'year_no',
                    'artnumber',
                    'page_start',
                    'page_end',
                    'page_count',
                    'codenid',
                    'pubmedid'], 'integer'],
                [['title_en',
                    'title_local',
                    'abbrev_title_en',
                    'abbrev_title_local',
                    'author_keyword_en',
                    'author_keyword_local',
                    'abstract_en',
                    'abstract_local',
                    'abstract_fulltext',
                    'author_keyword',
                    'auto_keyword',
                    'doi',
                    'link',
                    'funding',
                    'correspondence',
                    'sponsors',
                    'authors',
                    'subjectarea_class',
                    'created_by'], 'string'],
            ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/backend', 'ID'),
            'lang_id' => Yii::t('app/article_importer', 'Local Language'),
            'documenttype_id' => Yii::t('app/ctt_article', 'Documenttype'),
            'docsource_id' => Yii::t('app/ctt_article', 'Docsource'),
            'title_en' => Yii::t('app/article_importer', 'Title En'),
            'abbrev_title_en' => Yii::t('app/article_importer', 'Abbrev Title En'),
            'title_local' => Yii::t('app/article_importer', 'Title Local'),
            'abbrev_title_local' => Yii::t('app/article_importer', 'Abbrev Title Local'),
            'author_keyword_en' => Yii::t('app/article_importer', 'Author Keyword En'),
            'author_keyword_local' => Yii::t('app/article_importer', 'Author Keyword Local'),
            'abstract_en' => Yii::t('app/article_importer', 'Abstract En'),
            'abstract_local' => Yii::t('app/article_importer', 'Abstract Local'),
            'authors' => Yii::t('app/ctt_article', 'Authors'),
            'doi' => Yii::t('app/ctt_article', 'Doi'),
            'link' => Yii::t('app/ctt_article', 'Link'),
            'funding' => Yii::t('app/ctt_article', 'Funding'),
            'correspondence' => Yii::t('app/ctt_article', 'Correspondence'),
            'sponsors' => Yii::t('app/ctt_article', 'Sponsors'),
            'codenid' => Yii::t('app/ctt_article', 'Codenid'),
            'pubmedid' => Yii::t('app/ctt_article', 'Pubmedid'),
            'subjectarea_class' => Yii::t('app/ctt_article', 'Subjectarea Class'),
            'journal_id' => Yii::t('app/ctt_article', 'Journal'),
            'issue_id' => Yii::t('app/ctt_article', 'Issue ID'),
            'year' => Yii::t('app/ctt_article', 'Year'),
            'volume' => Yii::t('app/ctt_article', 'Volume'),
            'year_no' => Yii::t('app/ctt_article', 'Year No'),
            'artnumber' => Yii::t('app/ctt_article', 'Artnumber'),
            'page_start' => Yii::t('app/ctt_article', 'Page Start'),
            'page_end' => Yii::t('app/ctt_article', 'Page End'),
            'page_count' => Yii::t('app/ctt_article', 'Page Count'),
            'created_by' => Yii::t('app/backend', 'Created By'),
        ];
    }

    public function saveData()
    {
        try {
            if ($this->title_en &&
                $this->abbrev_title_en &&
                $this->author_keyword_en &&
                $this->abstract_en) {
                $this->saveDataByLange('en');
            }
            if ($this->title_local &&
                $this->abbrev_title_local &&
                $this->author_keyword_local &&
                $this->abstract_local) {
                $this->saveDataByLange('local');
            }

            return true;
        } catch (Exception $e) {
            ErrorHelper::throwActiveRecordError($e->getMessage());

            return false;
        }
    }

    public function saveDataByLange($lang)
    {
        $cttArticle = new CttArticles();
        if (empty($this->id)) {
           $this->id = $cttArticle->getId();
        }
        $cttArticle->id = $this->id;
        if ($lang == 'en') {
            // TODO: Getting this data from database directly
            $lang_id = 1;
        } else if ($lang == 'local') {
            $lang_id = $this->lang_id;
        }
        $cttArticle->lang_id = $lang_id;
        $cttArticle->lang = CttStaticdataLanguages::findOne($this->lang_id)->name;
        $cttArticle->documenttype_id = $this->documenttype_id;
        $cttArticle->documenttype =CttStaticdataDocumenttypes::findOne($this->documenttype_id)->name;
        if ($lang == 'en') {
            $cttArticle->title = $this->title_en;
            $cttArticle->abbrev_title = $this->abbrev_title_en;
            $cttArticle->author_keyword = $this->author_keyword_en;
            $cttArticle->abstract = $this->abstract_en;
        } else if ($lang == 'local') {
            $cttArticle->title = $this->title_local;
            $cttArticle->abbrev_title = $this->abbrev_title_local;
            $cttArticle->author_keyword = $this->author_keyword_local;
            $cttArticle->abstract = $this->abstract_local;
        }
        // CttAuthors
        $tmpAuthors = '';
        foreach ($this->authors['name'] as $key => $value) {
           $checkCttAuthors = $this->checkCttAuthors($value, $lang_id);
           $tmpAuthors .= ','.$value;
        }
        $this->authors = $tmpAuthors;
        // CttAuthors
        $cttArticle->doi = $this->doi;
        $cttArticle->link = $this->link;
        $cttArticle->funding = $this->funding;
        $cttArticle->correspondence = $this->correspondence;
        $cttArticle->sponsors = $this->sponsors;
        $cttArticle->codenid = $this->codenid;
        $cttArticle->pubmedid = $this->pubmedid;
        $cttArticle->subjectarea_class = $this->subjectarea_class;
        $cttArticle->journal_id = $this->journal_id;
        $cttArticle->journal = CttJournals::findOne($this->journal_id)->name;
        // Insert to CttIssue
        $checkCttIssues = $this->checkCttIssues();
        $cttArticle->year = $checkCttIssues->year;
        $cttArticle->volume = $checkCttIssues->volume;
        $cttArticle->year_no = $checkCttIssues->year_no;
        // Insert to CttIssue
        $cttArticle->artnumber = $this->artnumber;
        $cttArticle->page_start = $this->page_start;
        $cttArticle->page_end = $this->page_end;
        $cttArticle->page_count = $this->page_count;
        $cttArticle->created_by = $this->created_by;
        $cttArticle->modified_by = $this->created_by;
        if (!$cttArticle->save()) {
            ErrorHelper::throwActiveRecordError($cttArticle->errors);
        }

        // CttArticleDocsources
        // field docsource_id, docsource ใน table artcle ก็ไม่ต้องเอาอะไรลงไป ให้มา insert ที่ table ctt_article_docsources แทน
        foreach ($this->docsource_id as $key => $value) {
            $cttArticleDocsources = new CttArticleDocsources();
            $cttArticleDocsources->article_id = $cttArticle->id;
            $cttArticleDocsources->docsource_id = $value;
            $cttArticleDocsources->created_by = $created_by;
            if (!$cttArticleDocsources->save()) {
                ErrorHelper::throwActiveRecordError($cttArticleDocsources->errors);
            }
        }
        // CttArticleDocsources

        //**** Insert to CttStaticdataReferences
    }

    private function checkCttIssues()
    {
        $cttIssues = CttIssues::find()->where(['year' => $this->year, 'volume' => $this->volume]);
        if (empty($cttIssues)) {
            $cttIssues = new CttIssues();
            $cttIssues->id = $cttIssues->getId();
            $cttIssues->journal_id = $this->journal_id;
            $cttIssues->year = $this->year;
            $cttIssues->year_no = $this->year_no;
            $cttIssues->volume = $this->volume;
            $cttIssues->status = 'A';
            $cttIssues->created_by = $this->created_by;
            $cttIssues->modified_by = $this->created_by;

            if (!$cttIssues->save()) {
                ErrorHelper::throwActiveRecordError($cttIssues->errors);
            }
        }

        return $cttIssues;
    }

    private function checkCttAuthors($name, $lang_id)
    {
        $cttAuthors = CttAuthors::find()->where(['fname' => $name]);
        if (empty($cttIssues)) {
            $cttAuthors = new CttAuthors();
            $cttAuthors->id = $cttAuthors->getId();
            $cttAuthors->lang_id = $lang_id;
            $cttAuthors->fname = $name;
            // $cttAuthors->affiliation_id = $this->year_no;
            // $cttAuthors->organization_id = $this->volume
            $cttAuthors->status = 'A';
            $cttAuthors->created_by = $this->created_by;
            $cttAuthors->modified_by = $this->created_by;

            if (!$cttAuthors->save()) {
                ErrorHelper::throwActiveRecordError($cttAuthors->errors);
            }
        }

        return $cttIssues;
    }
}
