<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "ctt_article_authors".
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $author_id
 * @property integer $authortype_id
 * @property string $authortype
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttArticles $article
 * @property CttAuthors $author
 * @property CttStaticdataAuthortypes $authortype0
 */
class CttArticleAuthors extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_dtm', 'modified_dtm'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'modified_dtm',
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctt_article_authors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'author_id', 'authortype_id'], 'required'],
            [['article_id', 'author_id', 'authortype_id'], 'integer'],
            [['created_dtm', 'modified_dtm'], 'safe'],
            [['authortype', 'created_by', 'modified_by'], 'string', 'max' => 45]
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
            'author_id' => Yii::t('app', 'Author ID'),
            'authortype_id' => Yii::t('app', 'Authortype ID'),
            'authortype' => Yii::t('app', 'Authortype'),
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
    public function getAuthor()
    {
        return $this->hasOne(CttAuthors::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthortype0()
    {
        return $this->hasOne(CttStaticdataAuthortypes::className(), ['id' => 'authortype_id']);
    }
}
