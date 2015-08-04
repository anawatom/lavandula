<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CttPublishers */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ctt Publishers',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Publishers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_historyindication', 'Ctt Staticdata Historyindications(Language List)'),
                                    'url' => ['lang-list', 'id' => Yii::$app->request->getQueryParam('id')]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'lang_id' => $model->lang_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ctt-publishers-update">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'edit',
        'cttStaticdataLanguages' => $cttStaticdataLanguages,
        'cttStaticdataCountrys' => $cttStaticdataCountrys,
        'currentUser' => $currentUser,
    ]) ?>

</div>
