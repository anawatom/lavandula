<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "ctt_staticdata_subjectarea".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property string $lang
 * @property string $name
 * @property string $status
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttStaticdataSubjectareaClass[] $cttStaticdataSubjectareaClasses
 */
class CttStaticdataSubjectarea extends ActiveRecord
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
        return 'ctt_staticdata_subjectarea';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'name'], 'required'],
            [['id', 'lang_id'], 'integer'],
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
            'name' => Yii::t('app/ctt_staticdata_subjectarea', 'Name'),
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
            $id = CttSequences::getValue('STATICDATA_SUBJECTAREA_SEQ');
        } else {
           $id = $data->id;
        }

        return $id;
    }

    public static function getSubjectareaList()
    {
        return self::find()
                ->where('lang_id = (select min(lang_id)
                        from ctt_staticdata_subjectarea t2
                        where t2.id = ctt_staticdata_subjectarea.id
                        group by id)')
                ->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttStaticdataSubjectareaClasses()
    {
        return $this->hasMany(CttStaticdataSubjectareaClass::className(), ['subjectarea_id' => 'id']);
    }
}
