<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataOrganizations */
/* @var $form yii\widgets\ActiveForm */
$currentUser = \Yii::$app->user->getIdentity();
?>

<?= DetailView::widget([
    'model'=> $model,
    'condensed' => true,
    'hover' => true,
    'mode' => ($mode == 'create')? DetailView::MODE_EDIT: DetailView::MODE_EDIT,
    'panel'=>[
        'heading' => $title,
        'type' => DetailView::TYPE_PRIMARY,
        'footer' => Html::a('<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> '
                            .Yii::t('app/frontend', 'Back'),
                            Url::to(['lang-list',
                                    'id' => Yii::$app->request->getQueryParam('id')]),
                            ['class' => 'btn btn-danger']),
        'footerOptions' => [
            'tag' => 'div'
        ],
    ],
    'attributes' => [
        [
            'attribute' => 'lang_id',
            'label' => Yii::t('app/backend', 'Lang'),
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions'=>[
                'data' => ArrayHelper::map($cttStaticdataLanguage, 'id', 'name'),
                'options' => [],
                'pluginOptions' => ['allowClear' => true, 'width' => '100%'],
                'pluginEvents' => [
                    'change' => 'function() { $("#cttstaticdataorganizations-lang").val( $(this).find("option:selected").text() ); }',
                ],
            ],
        ],
        [
            'attribute' => 'lang',
            'type' => DetailView::INPUT_HIDDEN,
            'options' => [
                'value' => ($mode == 'create')? $cttStaticdataLanguage[0]['name']: $model->lang,
            ],
        ],
        [
            'attribute'=>'affiliation_id',
            'label' => Yii::t('app/ctt_staticdata_organization', 'Affiliation'),
            'type' =>  DetailView::INPUT_SELECT2,
            'widgetOptions'=>[
                'data'=>ArrayHelper::map($cttStaticdataAffiliation, 'id', 'name'),
            ],
        ],
        [
            'attribute' => 'name',
            'options' => [
            ],
        ],
        [
            'attribute' => 'alias',
            'options' => [
            ],
        ],
        [
            'attribute' => 'address',
            'type' => DetailView::INPUT_TEXTAREA,
            'options' => [
                            'rows' => '5'
                        ],
        ],
        [
            'attribute' => 'status',
            'type' => DetailView::INPUT_SELECT2 ,
            'widgetOptions'=>[
                'data' => Yii::$app->params['status'],
                'options' => [],
                'pluginOptions' => ['allowClear' => true, 'width' => '100%'],
                'pluginEvents' => [
                ],
            ],
        ],
        [
            'attribute' => 'created_by',
            'options' => [
                            'readonly' => 'readonly',
                            'value' => $currentUser->email,
                        ],
        ],
        [
            'attribute' => 'modified_by',
            'options' => [
                            'readonly' => 'readonly',
                            'value' => $currentUser->email,
                        ],
        ],
    ],
    'buttons2' => ($mode == 'create')? '{reset}{save}': '{reset}{save}',
    'resetOptions' => [
        'label' => '<span class="glyphicon glyphicon-ban-circle"></span>',
    ],
    'i18n' => [
        'class' => 'yii\i18n\PhpMessageSource',
        'basePath' => '@app/messages',
        'forceTranslation' => true
    ]
]);
?>