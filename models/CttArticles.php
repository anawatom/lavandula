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
 * @property integer $year
 * @property integer $journal_id
 * @property integer $publisher_id
 * @property string $journal
 * @property integer $volume
 * @property integer $issue_id
 * @property string $artnumber
 * @property integer $page_start
 * @property integer $page_end
 * @property integer $page_count
 * @property integer $cited
 * @property string $doi
 * @property string $link
 * @property integer $affiliation_id
 * @property string $affiliation
 * @property string $abstract
 * @property string $abstract_fulltext
 * @property string $author_keyword
 * @property string $auto_keyword
 * @property string $funding
 * @property string $correspondence
 * @property string $sponsors
 * @property string $codenid
 * @property string $pubmedid
 * @property string $checksum
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
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
            [['id', 'lang_id', 'title', 'abstract_fulltext'], 'required'],
            [['id', 'lang_id', 'documenttype_id', 'docsource_id', 'year', 'journal_id', 'publisher_id', 'volume', 'issue_id', 'page_start', 'page_end', 'page_count', 'cited', 'affiliation_id'], 'integer'],
            [['title_fulltext', 'abstract', 'abstract_fulltext', 'author_keyword', 'auto_keyword'], 'string'],
            [['created_dtm', 'modified_dtm'], 'safe'],
            [['lang', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['documenttype', 'abbrev_title'], 'string', 'max' => 100],
            [['docsource', 'alias_id', 'artnumber', 'doi', 'codenid', 'pubmedid'], 'string', 'max' => 50],
            [['title'], 'string', 'max' => 500],
            [['journal', 'link', 'affiliation', 'funding', 'correspondence', 'sponsors'], 'string', 'max' => 200],
            [['checksum'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lang_id' => 'Lang ID',
            'lang' => 'Lang',
            'documenttype_id' => 'Documenttype ID',
            'documenttype' => 'Documenttype',
            'docsource_id' => 'Docsource ID',
            'docsource' => 'Docsource',
            'alias_id' => 'Alias ID',
            'title' => 'Title',
            'abbrev_title' => 'Abbrev Title',
            'title_fulltext' => 'Title Fulltext',
            'year' => 'Year',
            'journal_id' => 'Journal ID',
            'publisher_id' => 'Publisher ID',
            'journal' => 'Journal',
            'volume' => 'Volume',
            'issue_id' => 'Issue ID',
            'artnumber' => 'Artnumber',
            'page_start' => 'Page Start',
            'page_end' => 'Page End',
            'page_count' => 'Page Count',
            'cited' => 'Cited',
            'doi' => 'Doi',
            'link' => 'Link',
            'affiliation_id' => 'Affiliation ID',
            'affiliation' => 'Affiliation',
            'abstract' => 'Abstract',
            'abstract_fulltext' => 'Abstract Fulltext',
            'author_keyword' => 'Author Keyword',
            'auto_keyword' => 'Auto Keyword',
            'funding' => 'Funding',
            'correspondence' => 'Correspondence',
            'sponsors' => 'Sponsors',
            'codenid' => 'Codenid',
            'pubmedid' => 'Pubmedid',
            'checksum' => 'Checksum',
            'created_by' => 'Created By',
            'created_dtm' => 'Created Dtm',
            'modified_by' => 'Modified By',
            'modified_dtm' => 'Modified Dtm',
        ];
    }
}
