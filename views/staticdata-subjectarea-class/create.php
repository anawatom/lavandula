<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataSubjectareaClass */

$this->title = Yii::t('app/ctt_staticdata_subjectarea_class', 'Create Ctt Staticdata Subjectarea Classes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_subjectarea_class', 'Ctt Staticdata Subjectarea Classes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_subjectarea_class', 'Ctt Staticdata Subjectarea Classes(Language List)'),
                                    'url' => ['lang-list', 'id' => Yii::$app->request->getQueryParam('id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-subjectarea-class-create">

    <?= $this->render('_form', [
        'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'create',
        'currentUser' => $currentUser,
		'cttStaticdataLanguages' => $cttStaticdataLanguages,
		'cttStaticdataSubjectareas' => $cttStaticdataSubjectareas
    ]) ?>

</div>
