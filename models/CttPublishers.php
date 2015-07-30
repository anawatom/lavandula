<?php

namespace app\models;

use Yii;

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
class CttPublishers extends \yii\db\ActiveRecord
{
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
            [['name', 'main_publisher', 'website', 'email'], 'string', 'max' => 200],
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
            'aliasid' => Yii::t('app', 'Aliasid'),
            'name' => Yii::t('app', 'Name'),
            'name_fulltext' => Yii::t('app', 'Name Fulltext'),
            'main_publisher' => Yii::t('app', 'Main Publisher'),
            'address' => Yii::t('app', 'Address'),
            'country_id' => Yii::t('app', 'Country ID'),
            'country' => Yii::t('app', 'Country'),
            'phone' => Yii::t('app', 'Phone'),
            'fax' => Yii::t('app', 'Fax'),
            'website' => Yii::t('app', 'Website'),
            'email' => Yii::t('app', 'Email'),
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
