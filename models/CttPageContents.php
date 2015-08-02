<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctt_page_contents".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property string $lang
 * @property integer $menu_id
 * @property string $elm_class
 * @property string $menu_type
 * @property string $name
 * @property string $contents
 * @property string $created_by
 * @property string $created_dtm
 * @property string $modified_by
 * @property string $modified_dtm
 */
class CttPageContents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctt_page_contents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lang_id', 'menu_id', 'name'], 'required'],
            [['lang_id', 'menu_id'], 'integer'],
            [['contents'], 'string'],
            [['created_dtm', 'modified_dtm'], 'safe'],
            [['lang', 'elm_class', 'menu_type', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 50]
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
            'menu_id' => Yii::t('app', 'Menu ID'),
            'elm_class' => Yii::t('app', 'Elm Class'),
            'menu_type' => Yii::t('app', 'Menu Type'),
            'name' => Yii::t('app', 'Name'),
            'contents' => Yii::t('app', 'Contents'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_dtm' => Yii::t('app', 'Created Dtm'),
            'modified_by' => Yii::t('app', 'Modified By'),
            'modified_dtm' => Yii::t('app', 'Modified Dtm'),
        ];
    }
}
