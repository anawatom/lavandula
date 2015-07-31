<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataAffiliations */

$this->title = Yii::t('app/ctt_staticdata_affiliation', 'Create Ctt Staticdata Affiliations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_affiliation', 'Ctt Staticdata Affiliations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_affiliation', 'Ctt Staticdata Affiliations(Language List)'),
                                    'url' => ['lang-list', 'id' => Yii::$app->request->getQueryParam('id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-affiliations-create">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'create',
    ]) ?>

</div>
