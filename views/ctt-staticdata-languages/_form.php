<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataLanguages */
/* @var $form yii\widgets\ActiveForm */

$currentUser = \Yii::$app->user->getIdentity();
?>

<div class="ctt-staticdata-languages-form form-container">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->hiddenInput(['value' => $currentUser->email])->label(false) ?>

    <?= $form->field($model, 'modified_by')->hiddenInput(['value' => $currentUser->email])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app/frontend', 'Create') : Yii::t('app/frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
