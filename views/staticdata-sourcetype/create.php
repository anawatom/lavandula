<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataSourcetypes */

$this->title = Yii::t('app', 'Create Ctt Staticdata Sourcetypes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Sourcetypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-sourcetypes-create">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'create',
    ]) ?>

</div>
