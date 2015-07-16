<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataAuthortypes */

$this->title = Yii::t('app', 'Create Ctt Staticdata Authortypes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Authortypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-authortypes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
