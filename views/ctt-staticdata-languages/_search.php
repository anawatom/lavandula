<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataLanguagesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ctt-staticdata-languages-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'offset' => '',
                'label' => 'col-md-3',
                'wrapper' => 'col-md-5',
                'error' => '',
                'hint' => '',
            ],
        ]
    ]); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'short_name') ?>

    <div class="form-group">
        <div class="col-md-offset-3 col-md-9">
            <?= Html::submitButton(Yii::t('app/frontend', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?php // echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
