<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataCountrys */

$this->title = Yii::t('app', 'Create Ctt Staticdata Countrys');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Countrys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-countrys-create">

    <?= $this->render('_form', [
		'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'create',
    ]) ?>

</div>
