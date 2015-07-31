<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataSubjectareaClass */

$this->title = Yii::t('app', 'Create Ctt Staticdata Subjectarea Class');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Subjectarea Classes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-subjectarea-class-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
