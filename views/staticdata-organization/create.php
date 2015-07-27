<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataOrganizations */

$this->title = Yii::t('app', 'Create Ctt Staticdata Organizations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-organizations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
