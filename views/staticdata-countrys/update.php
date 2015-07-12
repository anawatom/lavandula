<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataCountrys */

$this->title = Yii::t('app/ctt_staticdata_country', 'Update {modelClass}: ', [
    'modelClass' => 'Ctt Staticdata Countrys',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_country', 'Ctt Staticdata Country'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_country', 'Ctt Staticdata Countrys(Language List)'),
									'url' => ['lang-list', 'id' => $model->id]];
$this->params['breadcrumbs'][] = [
									'label' => $model->name,
									'url' => [
												'view',
												'id' => $model->id, 
												'lang_id' => $model->lang_id,
											]
								];
$this->params['breadcrumbs'][] = Yii::t('app/frontend', 'Update');
?>
<div class="ctt-staticdata-countrys-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'edit',
    ]) ?>

</div>
