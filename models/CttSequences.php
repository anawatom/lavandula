<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctt_sequences".
 *
 * @property integer $id
 * @property string $name
 * @property integer $value
 * @property integer $inc
 */
class CttSequences extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctt_sequences';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['value', 'inc'], 'integer'],
            [['name'], 'string', 'max' => 50]
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
            'value' => Yii::t('app', 'Value'),
            'inc' => Yii::t('app', 'Inc'),
        ];
    }
}
