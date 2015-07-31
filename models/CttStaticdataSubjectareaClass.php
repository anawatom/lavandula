<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctt_staticdata_subjectarea_class".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property string $lang
 * @property string $name
 * @property integer $subjectarea_id
 * @property string $status
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttArticleSubjectareaclass[] $cttArticleSubjectareaclasses
 * @property CttArticlereferenceSubjectareaclass[] $cttArticlereferenceSubjectareaclasses
 * @property CttAuthorSubjectareaclass[] $cttAuthorSubjectareaclasses
 * @property CttJournalSubjectareaclass[] $cttJournalSubjectareaclasses
 * @property CttStaticdataSubjectarea $subjectarea
 */
class CttStaticdataSubjectareaClass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctt_staticdata_subjectarea_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'subjectarea_id'], 'required'],
            [['id', 'lang_id', 'subjectarea_id'], 'integer'],
            [['created_dtm', 'modified_dtm'], 'safe'],
            [['lang', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lang_id' => Yii::t('app', 'Lang ID'),
            'lang' => Yii::t('app', 'Lang'),
            'name' => Yii::t('app', 'Name'),
            'subjectarea_id' => Yii::t('app', 'Subjectarea ID'),
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
    public function getCttArticleSubjectareaclasses()
    {
        return $this->hasMany(CttArticleSubjectareaclass::className(), ['subjectareaclass_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttArticlereferenceSubjectareaclasses()
    {
        return $this->hasMany(CttArticlereferenceSubjectareaclass::className(), ['subjectareaclass_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttAuthorSubjectareaclasses()
    {
        return $this->hasMany(CttAuthorSubjectareaclass::className(), ['subjectareaclass_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttJournalSubjectareaclasses()
    {
        return $this->hasMany(CttJournalSubjectareaclass::className(), ['subjectareaclass_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectarea()
    {
        return $this->hasOne(CttStaticdataSubjectarea::className(), ['id' => 'subjectarea_id']);
    }
}
