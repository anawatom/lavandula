<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataLanguages */

$this->title = Yii::t('app', 'Create Ctt Staticdata Languages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-languages-create create-page-container">

    <?= $this->render('_form', [
		'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'create',
    ]) ?>

</div>
