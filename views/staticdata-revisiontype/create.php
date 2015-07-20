<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataRevisiontypes */

$this->title = Yii::t('app/ctt_staticdata_revisiontype', 'Create Ctt Staticdata Revisiontypes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_revisiontype', 'Ctt Staticdata Revisiontypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_revisiontype', 'Ctt Staticdata Revisiontypes(Language List)'),
									'url' => ['lang-list', 'id' => Yii::$app->request->getQueryParam('id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-revisiontypes-create">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'create',
    ]) ?>

</div>
