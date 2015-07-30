<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctt_authors".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property string $lang
 * @property string $alias_id
 * @property string $orcid_id
 * @property string $other_id
 * @property string $fname
 * @property string $mname
 * @property string $lname
 * @property integer $affiliation_id
 * @property string $affiliation
 * @property integer $organization_id
 * @property string $organization
 * @property string $city
 * @property string $country
 * @property string $subjectarea_class
 * @property integer $citation
 * @property string $status
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttArticleAuthors[] $cttArticleAuthors
 * @property CttAuthorNamings[] $cttAuthorNamings
 * @property CttAuthorRevs[] $cttAuthorRevs
 * @property CttAuthorSubjectareaclass[] $cttAuthorSubjectareaclasses
 * @property CttStaticdataAffiliations $affiliation0
 * @property CttStaticdataOrganizations $organization0
 * @property CttReferenceAuthors[] $cttReferenceAuthors
 */
class CttAuthors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctt_authors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'fname', 'affiliation_id', 'organization_id'], 'required'],
            [['id', 'lang_id', 'affiliation_id', 'organization_id', 'citation'], 'integer'],
            [['created_dtm', 'modified_dtm'], 'safe'],
            [['lang', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['alias_id', 'orcid_id', 'city', 'country'], 'string', 'max' => 50],
            [['other_id', 'fname', 'mname', 'lname', 'affiliation', 'organization'], 'string', 'max' => 100],
            [['subjectarea_class'], 'string', 'max' => 500],
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
            'alias_id' => Yii::t('app', 'Alias ID'),
            'orcid_id' => Yii::t('app', 'Orcid ID'),
            'other_id' => Yii::t('app', 'Other ID'),
            'fname' => Yii::t('app', 'Fname'),
            'mname' => Yii::t('app', 'Mname'),
            'lname' => Yii::t('app', 'Lname'),
            'affiliation_id' => Yii::t('app', 'Affiliation ID'),
            'affiliation' => Yii::t('app', 'Affiliation'),
            'organization_id' => Yii::t('app', 'Organization ID'),
            'organization' => Yii::t('app', 'Organization'),
            'city' => Yii::t('app', 'City'),
            'country' => Yii::t('app', 'Country'),
            'subjectarea_class' => Yii::t('app', 'Subjectarea Class'),
            'citation' => Yii::t('app', 'Citation'),
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
    public function getCttArticleAuthors()
    {
        return $this->hasMany(CttArticleAuthors::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttAuthorNamings()
    {
        return $this->hasMany(CttAuthorNamings::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttAuthorRevs()
    {
        return $this->hasMany(CttAuthorRevs::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttAuthorSubjectareaclasses()
    {
        return $this->hasMany(CttAuthorSubjectareaclass::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAffiliation0()
    {
        return $this->hasOne(CttStaticdataAffiliations::className(), ['id' => 'affiliation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization0()
    {
        return $this->hasOne(CttStaticdataOrganizations::className(), ['id' => 'organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCttReferenceAuthors()
    {
        return $this->hasMany(CttReferenceAuthors::className(), ['author_id' => 'id']);
    }
}
