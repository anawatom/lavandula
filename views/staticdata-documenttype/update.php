<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataDocumenttypes */

$this->title = Yii::t('app/ctt_staticdata_documenttype', 'Update Ctt Staticdata Documenttypes') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_documenttype', 'Ctt Staticdata Documenttypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_documenttype', 'Ctt Staticdata Documenttypes(Language List)'),
                                    'url' => ['lang-list', 'id' => Yii::$app->request->getQueryParam('id')]];
$this->params['breadcrumbs'][] = Yii::t('app/frontend', 'Update');
?>
<div class="ctt-staticdata-documenttypes-update">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'edit',
    ]) ?>

</div>
