<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataAffiliations */

$this->title = Yii::t('app', 'Create Ctt Staticdata Affiliations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Affiliations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-affiliations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
