<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctt_article_docsources".
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $docsource_id
 * @property string $created_by
 * @property string $created_dtm
 *
 * @property CttStaticdataDocsources $docsource
 * @property CttArticles $article
 */
class CttArticleDocsources extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctt_article_docsources';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'docsource_id'], 'required'],
            [['article_id', 'docsource_id'], 'integer'],
            [['created_dtm'], 'safe'],
            [['created_by'], 'string', 'max' => 45]
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
            'docsource_id' => Yii::t('app', 'Docsource ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_dtm' => Yii::t('app', 'Created Dtm'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocsource()
    {
        return $this->hasOne(CttStaticdataDocsources::className(), ['id' => 'docsource_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(CttArticles::className(), ['id' => 'article_id']);
    }
}
