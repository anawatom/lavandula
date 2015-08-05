<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CttJournalsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ctt-journals-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'lang_id') ?>

    <?= $form->field($model, 'lang') ?>

    <?= $form->field($model, 'alias_id') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'name_fulltext') ?>

    <?php // echo $form->field($model, 'abbrev_name') ?>

    <?php // echo $form->field($model, 'issn') ?>

    <?php // echo $form->field($model, 'eissn') ?>

    <?php // echo $form->field($model, 'isbn') ?>

    <?php // echo $form->field($model, 'coverage') ?>

    <?php // echo $form->field($model, 'editor') ?>

    <?php // echo $form->field($model, 'open_status') ?>

    <?php // echo $form->field($model, 'access_status') ?>

    <?php // echo $form->field($model, 'source_type_id') ?>

    <?php // echo $form->field($model, 'source_type') ?>

    <?php // echo $form->field($model, 'print_lang') ?>

    <?php // echo $form->field($model, 'volume_per_year') ?>

    <?php // echo $form->field($model, 'issue_per_volume') ?>

    <?php // echo $form->field($model, 'history_indication_id') ?>

    <?php // echo $form->field($model, 'history_indication') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'country_id') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'website') ?>

    <?php // echo $form->field($model, 'publisher_id') ?>

    <?php // echo $form->field($model, 'subjectarea_class') ?>

    <?php // echo $form->field($model, 'organization_id') ?>

    <?php // echo $form->field($model, 'organization') ?>

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
