<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CttArticles */

$this->title = 'Update Ctt Articles: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Ctt Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id, 'lang_id' => $model->lang_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ctt-articles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
