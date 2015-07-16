<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataSourcetypes */

$this->title = Yii::t('app', 'Create Ctt Staticdata Sourcetypes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Sourcetypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-sourcetypes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
