<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "ctt_staticdata_revisiontypes".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property string $lang
 * @property string $class_name
 * @property string $name
 * @property string $status
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttArticleRevs[] $cttArticleRevs
 * @property CttAuthorRevs[] $cttAuthorRevs
 * @property CttJournalRevs[] $cttJournalRevs
 * @property CttPublisherRevs[] $cttPublisherRevs
 */
class CttStaticdataRevisiontypes extends ActiveRecord
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
        return 'ctt_staticdata_revisiontypes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'class_name', 'name'], 'required'],
            [['id', 'lang_id'], 'integer'],
            [['created_dtm', 'modified_dtm'], 'safe'],
            [['lang', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['class_name', 'name'], 'string', 'max' => 50],
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
            'lang_id' => Yii::t('app/ctt_staticdata_revisiontype', 'Lang ID'),
            'lang' => Yii::t('app/ctt_staticdata_revisiontype', 'Lang'),
            'class_name' => Yii::t('app/ctt_staticdata_revisiontype', 'Class Name'),
            'name' => Yii::t('app/ctt_staticdata_revisiontype', 'Name'),
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
            $id = CttSequences::getValue('STATICDATA_REVISIONTYPE_SEQ');
        } else {
           $id = $data->id;
        }

        return $id;
    }

    public static function getRevisiontypeList()
    {
        return self::find()
                ->where('lang_id = (select min(lang_id)
                        from ctt_staticdata_revisiontypes t2
                        where t2.id = ctt_staticdata_revisiontypes.id
                        group by id)')
                ->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttArticleRevs()
    {
        return $this->hasMany(CttArticleRevs::className(), ['rev_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttAuthorRevs()
    {
        return $this->hasMany(CttAuthorRevs::className(), ['rev_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttJournalRevs()
    {
        return $this->hasMany(CttJournalRevs::className(), ['rev_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttPublisherRevs()
    {
        return $this->hasMany(CttPublisherRevs::className(), ['rev_type_id' => 'id']);
    }
}
