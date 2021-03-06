<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "ctt_publishers".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property string $lang
 * @property string $aliasid
 * @property string $name
 * @property string $name_fulltext
 * @property string $main_publisher
 * @property string $address
 * @property integer $country_id
 * @property string $country
 * @property string $phone
 * @property string $fax
 * @property string $website
 * @property string $email
 * @property string $status
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttArticles[] $cttArticles
 * @property CttJournals[] $cttJournals
 * @property CttPublisherRevs[] $cttPublisherRevs
 * @property CttStaticdataCountrys $country0
 */
class CttPublishers extends ActiveRecord
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
        return 'ctt_publishers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'name'], 'required'],
            [['id', 'lang_id', 'country_id'], 'integer'],
            [['name_fulltext'], 'string'],
            [['created_dtm', 'modified_dtm'], 'safe'],
            [['lang', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['aliasid', 'country', 'phone', 'fax'], 'string', 'max' => 100],
            [['name', 'main_publisher', 'website'], 'string', 'max' => 200],
            [['address'], 'string', 'max' => 500],
            [['status'], 'string', 'max' => 1],
            [['email'], 'email']
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
            'aliasid' => Yii::t('app/ctt_publisher', 'Aliasid'),
            'name' => Yii::t('app/ctt_publisher', 'Name'),
            'name_fulltext' => Yii::t('app/ctt_publisher', 'Name Fulltext'),
            'main_publisher' => Yii::t('app/ctt_publisher', 'Main Publisher'),
            'address' => Yii::t('app/ctt_publisher', 'Address'),
            'country_id' => Yii::t('app/ctt_publisher', 'Country ID'),
            'country' => Yii::t('app/ctt_publisher', 'Country'),
            'phone' => Yii::t('app/ctt_publisher', 'Phone'),
            'fax' => Yii::t('app/ctt_publisher', 'Fax'),
            'website' => Yii::t('app/ctt_publisher', 'Website'),
            'email' => Yii::t('app/ctt_publisher', 'Email'),
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
            $id = CttSequences::getValue('PUBLISHER');
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
        return $this->hasMany(CttArticles::className(), ['publisher_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttJournals()
    {
        return $this->hasMany(CttJournals::className(), ['publisher_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttPublisherRevs()
    {
        return $this->hasMany(CttPublisherRevs::className(), ['publisher_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry0()
    {
        return $this->hasOne(CttStaticdataCountrys::className(), ['id' => 'country_id']);
    }
}
