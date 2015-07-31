<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataOrganizations */

$this->title = Yii::t('app/ctt_staticdata_organization', 'Create Ctt Staticdata Organizations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_organization', 'Ctt Staticdata Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_organization', 'Ctt Staticdata Organizations(Language List)'),
                                    'url' => ['lang-list', 'id' => Yii::$app->request->getQueryParam('id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-organizations-create">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'cttStaticdataLanguage' => $cttStaticdataLanguage,
        'cttStaticdataAffiliation' => $cttStaticdataAffiliation,
        'mode' => 'create',
    ]) ?>

</div>
