<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

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
class CttStaticdataAffiliations extends ActiveRecord
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
        return 'ctt_staticdata_affiliations';
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

    public function getId()
    {
        $id = '';
        $data = parent::find()->where(['name' => $this->name])->one();

        if (empty($data)) {
            $id = CttSequences::getValue('STATICDATA_AFFILIATION_SEQ');
        } else {
           $id = $data->id;
        }

        return $id;
    }

    public static function getAffiliationList()
    {
        return self::find()
                ->where('lang_id = (select min(lang_id)
                        from ctt_staticdata_affiliations t2
                        where t2.id = ctt_staticdata_affiliations.id
                        group by id)')
                ->all();
    }
}
