<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataCountrys */

$this->title = Yii::t('app', 'Create Ctt Staticdata Countrys');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Countrys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-countrys-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
