<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use app\helpers\ErrorHelper;

/**
 * This is the model class for table "ctt_publisher_revs".
 *
 * @property integer $id
 * @property integer $publisher_id
 * @property integer $lang_id
 * @property string $lang
 * @property integer $rev_type_id
 * @property string $rev_type
 * @property string $contents
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 *
 * @property CttPublishers $publisher
 * @property CttStaticdataRevisiontypes $revType
 */
class CttPublisherRevs extends ActiveRecord
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
        return 'ctt_publisher_revs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['publisher_id', 'lang_id', 'rev_type_id'], 'required'],
            [['publisher_id', 'lang_id', 'rev_type_id'], 'integer'],
            [['created_dtm'], 'safe'],
            [['lang', 'rev_type', 'created_by', 'modified_by', 'modified_dtm'], 'string', 'max' => 45],
            [['contents'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'publisher_id' => Yii::t('app', 'Publisher ID'),
            'lang_id' => Yii::t('app', 'Lang ID'),
            'lang' => Yii::t('app', 'Lang'),
            'rev_type_id' => Yii::t('app', 'Rev Type ID'),
            'rev_type' => Yii::t('app', 'Rev Type'),
            'contents' => Yii::t('app', 'Contents'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_dtm' => Yii::t('app', 'Created Dtm'),
            'modified_by' => Yii::t('app', 'Modified By'),
            'modified_dtm' => Yii::t('app', 'Modified Dtm'),
        ];
    }

    public function insertData($data)
    {
        $this->publisher_id = $data['publisher_id'];
        $this->lang_id = $data['lang_id'];
        $this->lang = $data['lang'];
        $this->rev_type_id = $data['rev_type_id'];
        $this->rev_type = $data['rev_type'];
        $this->contents = $data['contents'];

        if ($this->save()) {
            return true;
        } else {
           ErrorHelper::throwActiveRecordError($this->errors);
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisher()
    {
        return $this->hasOne(CttPublishers::className(), ['id' => 'publisher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRevType()
    {
        return $this->hasOne(CttStaticdataRevisiontypes::className(), ['id' => 'rev_type_id']);
    }
}
