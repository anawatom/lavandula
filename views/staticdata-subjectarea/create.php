<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataSubjectarea */

$this->title = Yii::t('app/ctt_staticdata_subjectarea', 'Create Ctt Staticdata Subjectareas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_subjectarea', 'Ctt Staticdata Subjectareas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_subjectarea', 'Ctt Staticdata Subjectareas(Language List)'),
                                    'url' => ['lang-list', 'id' => Yii::$app->request->getQueryParam('id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-subjectarea-create">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'create',
        'currentUser' => $currentUser,
		'cttStaticdataLanguages' => $cttStaticdataLanguages
    ]) ?>

</div>
