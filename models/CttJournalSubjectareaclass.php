<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctt_journal_subjectareaclass".
 *
 * @property integer $id
 * @property integer $journal_id
 * @property integer $subjectareaclass_id
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttJournals $journal
 * @property CttStaticdataSubjectareaClass $subjectareaclass
 */
class CttJournalSubjectareaclass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctt_journal_subjectareaclass';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['journal_id', 'subjectareaclass_id'], 'required'],
            [['journal_id', 'subjectareaclass_id'], 'integer'],
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
            'journal_id' => Yii::t('app', 'Journal ID'),
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
    public function getJournal()
    {
        return $this->hasOne(CttJournals::className(), ['id' => 'journal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectareaclass()
    {
        return $this->hasOne(CttStaticdataSubjectareaClass::className(), ['id' => 'subjectareaclass_id']);
    }
}
