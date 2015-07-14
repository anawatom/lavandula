<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataLanguages */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ctt Staticdata Languages',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ctt-staticdata-languages-update create-page-container">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'edit',
    ]) ?>

</div>
