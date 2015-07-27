<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "ctt_staticdata_organizations".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property string $lang
 * @property integer $affiliation_id
 * @property string $name
 * @property string $alias
 * @property string $address
 * @property string $status
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttArticles[] $cttArticles
 * @property CttAuthors[] $cttAuthors
 * @property CttJournals[] $cttJournals
 * @property CttStaticdataAffiliations $affiliation
 */
class CttStaticdataOrganizations extends ActiveRecord
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
        return 'ctt_staticdata_organizations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'affiliation_id', 'name', 'modified_dtm'], 'required'],
            [['id', 'lang_id', 'affiliation_id'], 'integer'],
            [['created_dtm', 'modified_dtm'], 'safe'],
            [['lang', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['name', 'alias'], 'string', 'max' => 200],
            [['address'], 'string', 'max' => 500],
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
            'affiliation_id' => Yii::t('app', 'Affiliation ID'),
            'name' => Yii::t('app', 'Name'),
            'alias' => Yii::t('app', 'Alias'),
            'address' => Yii::t('app', 'Address'),
            'status' => Yii::t('app', 'Status'),
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
            $id = CttSequences::getValue('STATICDATA_ORGANIZATION_SEQ');
        } else {
           $id = $data->id;
        }

        return $id;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttArticles()
    {
        return $this->hasMany(CttArticles::className(), ['organization_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttAuthors()
    {
        return $this->hasMany(CttAuthors::className(), ['organization_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttJournals()
    {
        return $this->hasMany(CttJournals::className(), ['organization_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAffiliation()
    {
        return $this->hasOne(CttStaticdataAffiliations::className(), ['id' => 'affiliation_id']);
    }
}
