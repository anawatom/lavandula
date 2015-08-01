<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

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
class CttStaticdataSubjectareaClass extends ActiveRecord
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
            'id' => Yii::t('app/backend', 'ID'),
            'lang_id' => Yii::t('app/backend', 'Lang ID'),
            'lang' => Yii::t('app/backend', 'Lang'),
            'name' => Yii::t('app/ctt_staticdata_subjectarea_class', 'Name'),
            'subjectarea_id' => Yii::t('app/ctt_staticdata_subjectarea_class', 'Subjectarea ID'),
            'status' => Yii::t('app/backend', 'Status'),
            'created_by' => Yii::t('app/backend', 'Created By'),
            'created_dtm' => Yii::t('app/backend', 'Created Dtm'),
            'modified_by' => Yii::t('app/backend', 'Modified By'),
            'modified_dtm' => Yii::t('app/backend', 'Modified Dtm'),
        ];
    }

    public function getId()
    {
        $id = '';
        $data = parent::find()->where(['name' => $this->name])->one();

        if (empty($data)) {
            $id = CttSequences::getValue('STATICDATA_SUBJECTAREACLASS_SEQ');
        } else {
           $id = $data->id;
        }

        return $id;
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
