<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttPublishers */

$this->title = Yii::t('app', 'Create Ctt Publishers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Publishers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-publishers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
