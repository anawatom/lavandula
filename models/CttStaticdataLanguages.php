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
            [['short_name', 'created_by', 'created_dtm', 'modified_by', 'modified_dtm'], 'required'],
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
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'short_name' => Yii::t('app', 'Short Name'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_dtm' => Yii::t('app', 'Created Dtm'),
            'modified_by' => Yii::t('app', 'Modified By'),
            'modified_dtm' => Yii::t('app', 'Modified Dtm'),
        ];
    }
}
