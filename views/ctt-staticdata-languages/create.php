<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataLanguages */

$this->title = Yii::t('app', 'Create Ctt Staticdata Languages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-languages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
