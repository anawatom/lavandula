<?php

use kartik\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataLanguages */
/* @var $form yii\widgets\ActiveForm */

$currentUser = \Yii::$app->user->getIdentity();
?>

<?= DetailView::widget([
    'model'=> $model,
    'condensed' => true,
    'hover' => true,
    'mode' => DetailView::MODE_EDIT,
    'panel'=>[
        'heading'=>'Language # ' . $model->id,
        'type'=>DetailView::TYPE_PRIMARY ,
    ],
    'attributes'=>[
        'name',
        'short_name',
        [
			'attribute' => 'created_by',
			'value' => $currentUser->email,
			'inputContainer' => ['class'=>'col-sm-6'],
			'labelColOptions' => ['style' => 'width: 10%'],
        ],
        [
			'attribute' => 'modified_by',
			'value' => $currentUser->email
        ]
    ]
]);
?>

// <?php

// use kartik\helpers\Html;
// use yii\widgets\ActiveForm;

// /* @var $this yii\web\View */
// /* @var $model app\models\CttStaticdataLanguages */
// /* @var $form yii\widgets\ActiveForm */

// $currentUser = \Yii::$app->user->getIdentity();
// ?>

// <div class="ctt-staticdata-languages-form form-container">

//     <?php $form = ActiveForm::begin(); ?>

//     <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

//     <?= $form->field($model, 'short_name')->textInput(['maxlength' => true]) ?>

//     <?= $form->field($model, 'created_by')->hiddenInput(['value' => $currentUser->email])->label(false) ?>

//     <?= $form->field($model, 'modified_by')->hiddenInput(['value' => $currentUser->email])->label(false) ?>

//     <div class="form-group">
//         <?= Html::submitButton($model->isNewRecord ? Yii::t('app/frontend', 'Create') : Yii::t('app/frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
//     </div>

//     <?php ActiveForm::end(); ?>

// </div>
