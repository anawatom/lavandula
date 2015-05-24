<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "WA_PROVINCE".
 *
 * @property  $PROVINCE_CODE
 * @property  $REGION_CODE
 * @property  $ZONE_CODE
 * @property  $PROVINCE_NAME_TH
 * @property  $PROVINCE_NAME_EN
 * @property  $CREATE_USER_ID
 * @property  $CREATE_TIME
 * @property  $LAST_UPD_USER_ID
 * @property  $LAST_UPD_TIME
 *
 * @property WAAMPHOE[] $wAAMPHOEs
 * @property WAREGION $1
 * @property WAZONE $10
 */
class WA_PROVINCE extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'WA_PROVINCE';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REGION_CODE', 'ZONE_CODE', 'PROVINCE_NAME_TH', 'CREATE_USER_ID', 'CREATE_TIME', 'LAST_UPD_USER_ID', 'LAST_UPD_TIME'], 'required'],
            [['REGION_CODE', 'ZONE_CODE'], 'string', 'max' => 2],
            [['PROVINCE_NAME_TH', 'PROVINCE_NAME_EN'], 'string', 'max' => 100],
            [['CREATE_USER_ID', 'LAST_UPD_USER_ID'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROVINCE_CODE' => 'Province  Code',
            'REGION_CODE' => 'Region  Code',
            'ZONE_CODE' => 'Zone  Code',
            'PROVINCE_NAME_TH' => 'Province  Name  Th',
            'PROVINCE_NAME_EN' => 'Province  Name  En',
            'CREATE_USER_ID' => 'Create  User  ID',
            'CREATE_TIME' => 'Create  Time',
            'LAST_UPD_USER_ID' => 'Last  Upd  User  ID',
            'LAST_UPD_TIME' => 'Last  Upd  Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWaAmphoes()
    {
        return $this->hasMany(WA_AMPHOE::className(), ['PROVINCE_CODE' => 'PROVINCE_CODE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function get1()
    {
        return $this->hasOne(WAREGION::className(), ['REGION_ID' => '1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function get10()
    {
        return $this->hasOne(WAZONE::className(), ['ZONE_CODE' => '1']);
    }
}
