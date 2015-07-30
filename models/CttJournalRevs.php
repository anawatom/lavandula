<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctt_journal_revs".
 *
 * @property integer $id
 * @property integer $journal_id
 * @property integer $lang_id
 * @property string $lang
 * @property integer $rev_type_id
 * @property string $rev_type
 * @property string $contents
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttJournals $journal
 * @property CttStaticdataRevisiontypes $revType
 */
class CttJournalRevs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctt_journal_revs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['journal_id', 'lang_id', 'rev_type_id'], 'required'],
            [['journal_id', 'lang_id', 'rev_type_id'], 'integer'],
            [['created_dtm'], 'safe'],
            [['lang', 'rev_type', 'contents', 'created_by', 'modified_by', 'modified_dtm'], 'string', 'max' => 45]
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
            'lang_id' => Yii::t('app', 'Lang ID'),
            'lang' => Yii::t('app', 'Lang'),
            'rev_type_id' => Yii::t('app', 'Rev Type ID'),
            'rev_type' => Yii::t('app', 'Rev Type'),
            'contents' => Yii::t('app', 'Contents'),
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
    public function getRevType()
    {
        return $this->hasOne(CttStaticdataRevisiontypes::className(), ['id' => 'rev_type_id']);
    }
}
