<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataSourcetypes */

$this->title = Yii::t('app/ctt_staticdata_sourcetype', 'Update Ctt Staticdata Sourcetypes') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_sourcetype', 'Ctt Staticdata Sourcetypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_sourcetype', 'Ctt Staticdata Sourcetypes(Language List)'),
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
<div class="ctt-staticdata-sourcetypes-update">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'edit',
    ]) ?>

</div>
