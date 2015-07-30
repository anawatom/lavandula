<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctt_reference_authors".
 *
 * @property integer $id
 * @property integer $articlereference_id
 * @property integer $author_id
 * @property integer $authortype_id
 * @property string $authortype
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttArticleReferences $articlereference
 * @property CttAuthors $author
 * @property CttStaticdataDocumenttypes $authortype0
 */
class CttReferenceAuthors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctt_reference_authors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['articlereference_id', 'author_id', 'authortype_id'], 'required'],
            [['articlereference_id', 'author_id', 'authortype_id'], 'integer'],
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
            'articlereference_id' => Yii::t('app', 'Articlereference ID'),
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
    public function getArticlereference()
    {
        return $this->hasOne(CttArticleReferences::className(), ['id' => 'articlereference_id']);
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
        return $this->hasOne(CttStaticdataDocumenttypes::className(), ['id' => 'authortype_id']);
    }
}
