<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttJournals */

$this->title = Yii::t('app', 'Create Ctt Journals');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Journals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-journals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
