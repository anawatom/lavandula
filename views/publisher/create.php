<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttPublishers */

$this->title = Yii::t('app', 'Create Ctt Publishers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Publishers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_historyindication', 'Ctt Staticdata Historyindications(Language List)'),
                                    'url' => ['lang-list', 'id' => Yii::$app->request->getQueryParam('id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-publishers-create">

     <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'create',
        'cttStaticdataLanguages' => $cttStaticdataLanguages,
        'cttStaticdataCountrys' => $cttStaticdataCountrys,
        'currentUser' => $currentUser,
    ]) ?>

</div>
