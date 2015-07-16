<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataDocsources */

$this->title = Yii::t('app', 'Create Ctt Staticdata Docsources');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Docsources'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-docsources-create">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'create',
    ]) ?>

</div>
