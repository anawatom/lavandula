<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataCountrys */

$this->title = Yii::t('app/ctt_staticdata_country', 'Create Ctt Staticdata Countrys');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_country', 'Ctt Staticdata Countrys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_country', 'Ctt Staticdata Countrys(Language List)'),
									'url' => ['lang-list', 'id' => Yii::$app->request->getQueryParam('id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-countrys-create">

    <?= $this->render('_form', [
		'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'create',
    ]) ?>

</div>
