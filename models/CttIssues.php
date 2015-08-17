<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "ctt_issues".
 *
 * @property integer $id
 * @property string $alias_id
 * @property integer $journal_id
 * @property integer $year
 * @property integer $year_no
 * @property string $volume
 * @property string $status
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttArticles[] $cttArticles
 * @property CttJournals $journal
 */
class CttIssues extends ActiveRecord
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
        return 'ctt_issues';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'journal_id'], 'required'],
            [['id', 'journal_id', 'year', 'year_no'], 'integer'],
            [['created_dtm', 'modified_dtm'], 'safe'],
            [['alias_id'], 'string', 'max' => 50],
            [['volume'], 'string', 'max' => 10],
            [['status'], 'string', 'max' => 1],
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
            'alias_id' => Yii::t('app', 'Alias ID'),
            'journal_id' => Yii::t('app', 'Journal ID'),
            'year' => Yii::t('app', 'Year'),
            'year_no' => Yii::t('app', 'Year No'),
            'volume' => Yii::t('app', 'Volume'),
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
    public function getCttArticles()
    {
        return $this->hasMany(CttArticles::className(), ['issue_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournal()
    {
        return $this->hasOne(CttJournals::className(), ['id' => 'journal_id']);
    }
}
