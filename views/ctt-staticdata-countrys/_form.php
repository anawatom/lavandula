<?php

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\helpers\Html;
use kartik\detail\DetailView;
use kartik\widgets\DepDrop;
use app\models\CttStaticdataLanguages;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataCountrys */
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
                            Url::to(['ctt-staticdata-countrys/lang-list',
                                    'id' => Yii::$app->request->getQueryParam('id')]),
                            ['class' => 'btn btn-danger']),
        'footerOptions' => [
            'tag' => 'div'
        ],
    ],
    'attributes' => [
        [
			'attribute' => 'lang_id',
			'type' => DetailView::INPUT_SELECT2,
			'widgetOptions'=>[
				'data' => ArrayHelper::map(CttStaticdataLanguages::find()->asArray()->all(), 'id', 'name'),
				'options' => ['placeholder' => 'Select ...'],
				'pluginOptions' => ['allowClear' => true, 'width' => '100%'],
                'pluginEvents' => [
                    'change' => 'function() { $("#cttstaticdatacountrys-lang").val( $(this).find("option:selected").text() ); }',
                ],
			],
        ],
        [
            'attribute' => 'lang',
            'type' => DetailView::INPUT_HIDDEN,
            'options' => [
                'value' => ($mode == 'create')? '': $model->lang,
            ],
        ],
        'name',
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
]);
?>

<?php
    // $this->registerJsFile('@web/web/web-assets/js/ctt-staticdata-languages-form.js');
?>

