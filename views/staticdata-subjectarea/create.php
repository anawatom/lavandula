<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataSubjectarea */

$this->title = Yii::t('app', 'Create Ctt Staticdata Subjectarea');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Subjectareas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-subjectarea-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
