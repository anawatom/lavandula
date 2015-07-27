<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataAffiliationsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ctt-staticdata-affiliations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'lang_id') ?>

    <?= $form->field($model, 'lang') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'alias') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_dtm') ?>

    <?php // echo $form->field($model, 'modified_by') ?>

    <?php // echo $form->field($model, 'modified_dtm') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
