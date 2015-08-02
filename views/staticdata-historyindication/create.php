<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataHistoryindications */

$this->title = Yii::t('app', 'Create Ctt Staticdata Historyindications');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Historyindications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-historyindications-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
