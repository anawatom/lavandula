<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataSubjectareaClassSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ctt-staticdata-subjectarea-class-search">

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

    <div class="form-group">
        <div class="col-md-offset-3 col-md-9">
            <?= Html::submitButton(Yii::t('app/frontend', 'Search'),
                                    ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app/frontend', 'Reset'),
                        ['index'],
                        ['class' => 'btn btn-danger']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
