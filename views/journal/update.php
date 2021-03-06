<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CttJournals */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ctt Journals',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Journals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'lang_id' => $model->lang_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ctt-journals-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
