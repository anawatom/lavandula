<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttArticles */

$this->title = 'Create Ctt Articles';
$this->params['breadcrumbs'][] = ['label' => 'Ctt Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-articles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
