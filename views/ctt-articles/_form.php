<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CttArticles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ctt-articles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'lang_id')->textInput() ?>

    <?= $form->field($model, 'lang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documenttype_id')->textInput() ?>

    <?= $form->field($model, 'documenttype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'docsource_id')->textInput() ?>

    <?= $form->field($model, 'docsource')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abbrev_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_fulltext')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'journal_id')->textInput() ?>

    <?= $form->field($model, 'publisher_id')->textInput() ?>

    <?= $form->field($model, 'journal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'volume')->textInput() ?>

    <?= $form->field($model, 'issue_id')->textInput() ?>

    <?= $form->field($model, 'artnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'page_start')->textInput() ?>

    <?= $form->field($model, 'page_end')->textInput() ?>

    <?= $form->field($model, 'page_count')->textInput() ?>

    <?= $form->field($model, 'cited')->textInput() ?>

    <?= $form->field($model, 'doi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'affiliation_id')->textInput() ?>

    <?= $form->field($model, 'affiliation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abstract')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'author_keyword')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'auto_keyword')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'funding')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'correspondence')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sponsors')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codenid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pubmedid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checksum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_dtm')->textInput() ?>

    <?= $form->field($model, 'modified_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modified_dtm')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
