<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataLanguages */

$this->title = Yii::t('app/ctt_staticdata_language', 'Create Ctt Staticdata Languages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_language', 'Ctt Staticdata Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-languages-create create-page-container">

    <?= $this->render('_form', [
		'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'create',
    ]) ?>

</div>
