<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataHistoryindications */

$this->title = Yii::t('app/ctt_staticdata_historyindication', 'Create Ctt Staticdata Historyindications');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_historyindication', 'Ctt Staticdata Historyindications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_historyindication', 'Ctt Staticdata Historyindications(Language List)'),
                                    'url' => ['lang-list', 'id' => Yii::$app->request->getQueryParam('id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-historyindications-create">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'create',
        'cttStaticdataLanguages' => $cttStaticdataLanguages,
        'currentUser' => $currentUser,
    ]) ?>

</div>
