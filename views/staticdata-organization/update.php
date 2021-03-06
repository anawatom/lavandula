<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataOrganizations */

$this->title = Yii::t('app/ctt_staticdata_organization', 'Update Ctt Staticdata Organizations') . ' : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_organization', 'Ctt Staticdata Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_organization', 'Ctt Staticdata Organizations(Language List)'),
                                    'url' => ['lang-list', 'id' => Yii::$app->request->getQueryParam('id')]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'lang_id' => $model->lang_id]];
$this->params['breadcrumbs'][] = Yii::t('app/frontend', 'Update');
?>
<div class="ctt-staticdata-organizations-update">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'cttStaticdataLanguage' => $cttStaticdataLanguage,
        'cttStaticdataAffiliation' => $cttStaticdataAffiliation,
        'mode' => 'edit',
    ]) ?>

</div>
