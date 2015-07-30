<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctt_author_subjectareaclass".
 *
 * @property integer $id
 * @property integer $author_id
 * @property integer $subjectareaclass_id
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttAuthors $author
 * @property CttStaticdataSubjectareaClass $subjectareaclass
 */
class CttAuthorSubjectareaclass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctt_author_subjectareaclass';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'subjectareaclass_id'], 'required'],
            [['author_id', 'subjectareaclass_id'], 'integer'],
            [['created_dtm', 'modified_dtm'], 'safe'],
            [['created_by', 'modified_by'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'author_id' => Yii::t('app', 'Author ID'),
            'subjectareaclass_id' => Yii::t('app', 'Subjectareaclass ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_dtm' => Yii::t('app', 'Created Dtm'),
            'modified_by' => Yii::t('app', 'Modified By'),
            'modified_dtm' => Yii::t('app', 'Modified Dtm'),
        ];
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
    public function getSubjectareaclass()
    {
        return $this->hasOne(CttStaticdataSubjectareaClass::className(), ['id' => 'subjectareaclass_id']);
    }
}
