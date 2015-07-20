<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataRevisiontypes */

$this->title = Yii::t('app', 'Create Ctt Staticdata Revisiontypes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Revisiontypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-revisiontypes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
