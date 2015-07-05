<?php

namespace app\models;

use Yii;

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
class CttStaticdataCountrys extends \yii\db\ActiveRecord
{
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
            'id' => Yii::t('app', 'ID'),
            'lang_id' => Yii::t('app', 'Lang ID'),
            'lang' => Yii::t('app', 'Lang'),
            'name' => Yii::t('app', 'Name'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_dtm' => Yii::t('app', 'Created Dtm'),
            'modified_by' => Yii::t('app', 'Modified By'),
            'modified_dtm' => Yii::t('app', 'Modified Dtm'),
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
