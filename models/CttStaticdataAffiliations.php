<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctt_staticdata_affiliations".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property string $lang
 * @property string $name
 * @property string $alias
 * @property string $address
 * @property string $status
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 */
class CttStaticdataAffiliations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctt_staticdata_affiliations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'name', 'modified_dtm'], 'required'],
            [['id', 'lang_id'], 'integer'],
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
            'id' => 'ID',
            'lang_id' => 'Lang ID',
            'lang' => 'Lang',
            'name' => 'Name',
            'alias' => 'Alias',
            'address' => 'Address',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_dtm' => 'Created Dtm',
            'modified_by' => 'Modified By',
            'modified_dtm' => 'Modified Dtm',
        ];
    }
}
