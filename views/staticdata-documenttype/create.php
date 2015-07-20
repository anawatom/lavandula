<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataDocumenttypes */

$this->title = Yii::t('app/ctt_staticdata_documenttype', 'Create Ctt Staticdata Documenttypes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_documenttype', 'Ctt Staticdata Documenttypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_documenttype', 'Ctt Staticdata Documenttypes(Language List)'),
                                    'url' => ['lang-list', 'id' => Yii::$app->request->getQueryParam('id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-documenttypes-create">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'create',
    ]) ?>

</div>
