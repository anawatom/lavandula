<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "ctt_staticdata_countrys".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property string $lang
 * @property string $name
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttPublishers[] $cttPublishers
 */
class CttStaticdataCountrys extends ActiveRecord
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
        return 'ctt_staticdata_countrys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lang', 'name', 'created_by', 'modified_by'], 'required'],
            [['id', 'lang_id'], 'integer'],
            [['created_dtm', 'modified_dtm'], 'safe'],
            [['lang', 'name', 'created_by', 'modified_by'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/ctt_staticdata_country', 'ID'),
            'lang_id' => Yii::t('app/ctt_staticdata_country', 'Lang ID'),
            'lang' => Yii::t('app/ctt_staticdata_country', 'Lang'),
            'name' => Yii::t('app/ctt_staticdata_country', 'Name'),
            'created_by' => Yii::t('app/ctt_staticdata_country', 'Created By'),
            'created_dtm' => Yii::t('app/ctt_staticdata_country', 'Created Dtm'),
            'modified_by' => Yii::t('app/ctt_staticdata_country', 'Modified By'),
            'modified_dtm' => Yii::t('app/ctt_staticdata_country', 'Modified Dtm'),
        ];
    }

    public function getId() 
    {
        $id = '';
        $data = parent::find()->where(['name' => $this->name])->one();

        if (empty($data)) {
            $id = CttSequences::getValue('STATICDATA_COUNTRY_SEQ');
        } else {
           $id = $data->id;
        }

        return $id;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttPublishers()
    {
        return $this->hasMany(CttPublishers::className(), ['country_id' => 'id']);
    }
}
