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
 * @property string $main_publisher
 * @property string $editor
 * @property string $address
 * @property integer $country_id
 * @property string $country
 * @property string $phone
 * @property string $website
 * @property string $email
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
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
            [['lang_id', 'country_id'], 'integer'],
            [['lang', 'aliasid', 'main_publisher', 'editor', 'address', 'country_id', 'country', 'phone', 'website', 'email', 'created_by', 'created_dtm', 'modified_by', 'modified_dtm'], 'required'],
            [['name'], 'string'],
            [['created_dtm', 'modified_dtm'], 'safe'],
            [['lang', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['aliasid', 'country', 'phone'], 'string', 'max' => 100],
            [['main_publisher', 'editor', 'website', 'email'], 'string', 'max' => 200],
            [['address'], 'string', 'max' => 500]
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
            'aliasid' => Yii::t('app', 'Publisher ID'),
            'name' => Yii::t('app', 'Publisher\'s Name'),
            'main_publisher' => Yii::t('app', 'Publisher imprints grouped to main Publisher'),
            'editor' => Yii::t('app', 'Editors'),
            'address' => Yii::t('app', 'Publisher\'s address'),
            'country_id' => Yii::t('app', 'Country ID'),
            'country' => Yii::t('app', 'Publisher\'s country'),
            'phone' => Yii::t('app', 'Publisher\'s phone'),
            'website' => Yii::t('app', 'Publisher\'s website'),
            'email' => Yii::t('app', 'Publisher\'s email'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_dtm' => Yii::t('app', 'Created Dtm'),
            'modified_by' => Yii::t('app', 'Modified By'),
            'modified_dtm' => Yii::t('app', 'Modified Dtm'),
        ];
    }
}
