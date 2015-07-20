<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataRevisiontypes */

$this->title = Yii::t('app', 'Update Ctt Staticdata Revisiontypes') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_revisiontype', 'Ctt Staticdata Revisiontypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_revisiontype', 'Ctt Staticdata Revisiontypes(Language List)'),
									'url' => ['lang-list', 'id' => Yii::$app->request->getQueryParam('id')]];
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
<div class="ctt-staticdata-revisiontypes-update">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'edit',
    ]) ?>

</div>
