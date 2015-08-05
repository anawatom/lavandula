<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CttJournals */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ctt-journals-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'lang_id')->textInput() ?>

    <?= $form->field($model, 'lang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_fulltext')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'abbrev_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'issn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eissn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coverage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'editor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'open_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'access_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'source_type_id')->textInput() ?>

    <?= $form->field($model, 'source_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'print_lang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'volume_per_year')->textInput() ?>

    <?= $form->field($model, 'issue_per_volume')->textInput() ?>

    <?= $form->field($model, 'history_indication_id')->textInput() ?>

    <?= $form->field($model, 'history_indication')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country_id')->textInput() ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publisher_id')->textInput() ?>

    <?= $form->field($model, 'subjectarea_class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'organization_id')->textInput() ?>

    <?= $form->field($model, 'organization')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_dtm')->textInput() ?>

    <?= $form->field($model, 'modified_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modified_dtm')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
