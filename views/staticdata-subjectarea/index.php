<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CttStaticdataSubjectareaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ctt Staticdata Subjectareas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-subjectarea-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ctt Staticdata Subjectarea'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'lang_id',
            'lang',
            'name',
            'status',
            // 'created_by',
            // 'created_dtm',
            // 'modified_by',
            // 'modified_dtm',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
