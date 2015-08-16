<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\CttArticles;
use app\models\CttStaticdataReferences;
use app\models\CttAuthors;
use app\models\CttIssue;

/**
 * ArticleImporter is the model behind the login form.
 */
class ArticleImporter extends Model
{
    public $lang_id;
    public $documenttype_id;
    public $docsources;
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
    public $journal;
    public $issue_id;
    public $year;
    public $volume;
    public $year_no;
    public $artnumber;
    public $page_start;
    public $page_end;
    public $page_count;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
                [['lang_id',
                'documenttype_id',
                'docsources',
                'title_en',
                'abbrev_title_en',
                'title_local',
                'abbrev_title_local',
                'author_keyword_en',
                'author_keyword_local',
                'abstract_en',
                'abstract_local',
                'authors',
                'doi',
                'link',
                'funding',
                'correspondence',
                'sponsors',
                'codenid',
                'pubmedid',
                'subjectarea_class',
                'journal_id',
                'journal',
                'issue_id',
                'year',
                'volume',
                'year_no',
                'artnumber',
                'page_start',
                'page_end',
                'page_count'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        // lang_id
        // documenttype_id
        // docsources
        // title_en
        // abbrev_title_en
        // local_title
        // abbrev_title_en
        // abstract_en
        // abstract_locl
        // authors
        // doi
        // link
        // funding
        // correspondence
        // sponsors
        // codenid
        // pubmedid
        // subjectarea_class
        // journal_id
        // journal
        // issue_id
        // year
        // volume
        // artnumber
        // page_start
        // page_end
        // page_count

        return [
            'lang_id' => Yii::t('app/article_importer', 'Local Language'),
            'documenttype_id' => Yii::t('app/ctt_article', 'Documenttype ID'),
            'docsources' => Yii::t('app/ctt_article', 'Docsource'),
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
            'journal_id' => Yii::t('app/ctt_article', 'Journal ID'),
            'journal' => Yii::t('app/ctt_article', 'Journal'),
            'issue_id' => Yii::t('app/ctt_article', 'Issue ID'),
            'year' => Yii::t('app/ctt_article', 'Year'),
            'volume' => Yii::t('app/ctt_article', 'Volume'),
            'year_no' => Yii::t('app/ctt_article', 'Year No'),
            'artnumber' => Yii::t('app/ctt_article', 'Artnumber'),
            'page_start' => Yii::t('app/ctt_article', 'Page Start'),
            'page_end' => Yii::t('app/ctt_article', 'Page End'),
            'page_count' => Yii::t('app/ctt_article', 'Page Count')
        ];
    }

    public function saveData()
    {
       
       

        return true;
    }

    private function createCttArticles($lang)
    {
        // Create ctt_article
        $cttArticle = new CttArticles();
        $cttArticle->load();

//          [
//     'lang_id' => '1'
//     'documenttype_id' => '1'
//     'docsources' => ''
//     'title_en' => ''
//     'abbrev_title_en' => ''
//     'title_local' => ''
//     'abbrev_title_local' => ''
//     'author_keyword_en' => ''
//     'author_keyword_local' => ''
//     'abstract_en' => ''
//     'abstract_local' => ''
//     'authors' => ''
//     'doi' => ''
//     'link' => ''
//     'funding' => ''
//     'correspondence' => ''
//     'sponsors' => ''
//     'codenid' => ''
//     'pubmedid' => ''
//     'subjectarea_class' => '1'
//     'journal_id' => '1'
//     'year' => ''
//     'volume' => ''
//     'year_no' => ''
//     'artnumber' => ''
//     'page_start' => ''
//     'page_end' => ''
//     'page_count' => ''
// ]
    }

}
