<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctt_staticdata_documenttypes".
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
 * @property CttArticles[] $cttArticles
 * @property CttReferenceAuthors[] $cttReferenceAuthors
 */
class CttStaticdataDocumenttypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctt_staticdata_documenttypes';
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
            [['lang', 'name', 'created_by', 'modified_by'], 'string', 'max' => 45],
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
        return $this->hasMany(CttArticles::className(), ['documenttype_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttReferenceAuthors()
    {
        return $this->hasMany(CttReferenceAuthors::className(), ['authortype_id' => 'id']);
    }
}
