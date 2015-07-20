<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataSourcetypes */

$this->title = Yii::t('app/ctt_staticdata_sourcetype', 'Create Ctt Staticdata Sourcetypes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_sourcetype', 'Ctt Staticdata Sourcetypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_sourcetype', 'Ctt Staticdata Sourcetypes(Language List)'),
                                    'url' => ['lang-list', 'id' => Yii::$app->request->getQueryParam('id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-sourcetypes-create">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'create',
    ]) ?>

</div>
