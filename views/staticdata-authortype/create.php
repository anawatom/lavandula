<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataAuthortypes */

$this->title = Yii::t('app/ctt_staticdata_authortype', 'Create Ctt Staticdata Authortypes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_authortype', 'Ctt Staticdata Authortypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_authortype', 'Ctt Staticdata Authortypes(Language List)'),
                                    'url' => ['lang-list', 'id' => Yii::$app->request->getQueryParam('id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-authortypes-create">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'create',
    ]) ?>

</div>
