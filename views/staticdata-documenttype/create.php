<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataDocumenttypes */

$this->title = Yii::t('app', 'Create Ctt Staticdata Documenttypes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Documenttypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_docsource', 'Ctt Staticdata Docsources'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-documenttypes-create">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'create',
    ]) ?>

</div>
