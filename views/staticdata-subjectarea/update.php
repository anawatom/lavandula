<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataSubjectarea */

$this->title = Yii::t('app/ctt_staticdata_subjectarea', 'Update Ctt Staticdata Subjectareas') . ' : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_subjectarea', 'Ctt Staticdata Subjectareas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_subjectarea', 'Ctt Staticdata Subjectareas(Language List)'),
                                    'url' => ['lang-list', 'id' => Yii::$app->request->getQueryParam('id')]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'lang_id' => $model->lang_id]];
$this->params['breadcrumbs'][] = Yii::t('app/frontend', 'Update');
?>
<div class="ctt-staticdata-subjectarea-update">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'edit',
        'currentUser' => $currentUser,
		'cttStaticdataLanguages' => $cttStaticdataLanguages
    ]) ?>

</div>
