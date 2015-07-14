<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctt_staticdata_languages".
 *
 * @property integer $id
 * @property string $name
 * @property string $short_name
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttPublishers[] $cttPublishers
 */
class CttStaticdataLanguages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctt_staticdata_languages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['short_name', 'created_by', 'modified_by'], 'required'],
            [['created_dtm', 'modified_dtm'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['short_name'], 'string', 'max' => 10],
            [['created_by', 'modified_by'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/backend', 'ID'),
            'name' => Yii::t('app/ctt_staticdata_language', 'Name'),
            'short_name' => Yii::t('app/ctt_staticdata_language', 'Short Name'),
            'created_by' => Yii::t('app/backend', 'Created By'),
            'created_dtm' => Yii::t('app/backend', 'Created Dtm'),
            'modified_by' => Yii::t('app/backend', 'Modified By'),
            'modified_dtm' => Yii::t('app/backend', 'Modified Dtm'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttPublishers()
    {
        return $this->hasMany(CttPublishers::className(), ['lang_id' => 'id']);
    }
}
