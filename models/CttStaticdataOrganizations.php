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
 * @property string $name_full
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
            [['id', 'lang_id', 'affiliation_id', 'name'], 'required'],
            [['id', 'lang_id', 'affiliation_id'], 'integer'],
            [['created_dtm', 'modified_dtm'], 'safe'],
            [['lang', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['name', 'name_full', 'alias'], 'string', 'max' => 200],
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
            'id' => Yii::t('app/backend', 'ID'),
            'lang_id' => Yii::t('app/backend', 'Lang ID'),
            'lang' => Yii::t('app/backend', 'Lang'),
            'affiliation_id' => Yii::t('app/ctt_staticdata_organization', 'Affiliation ID'),
            'name' => Yii::t('app/ctt_staticdata_organization', 'Name'),
            'name_full' => Yii::t('app/ctt_staticdata_organization', 'Name Full'),
            'alias' => Yii::t('app/ctt_staticdata_organization', 'Alias'),
            'address' => Yii::t('app/ctt_staticdata_organization', 'Address'),
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
            $id = CttSequences::getValue('STATICDATA_ORGANIZATION_SEQ');
        } else {
           $id = $data->id;
        }

        return $id;
    }

    public static function getOrganizationList($params = null)
    {
        return self::find()
                ->where('lang_id = (select min(lang_id)
                        from ctt_staticdata_organizations t2
                        where t2.id = ctt_staticdata_organizations.id
                        and t2.name like :name
                        group by id)',
                        [
                            ':name' => isset($params['name'])? '%'.$params['name'].'%': '%%',
                        ])
                ->all();
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
