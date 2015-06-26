<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CttStaticdataLanguagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ctt Staticdata Languages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-languages-index index-page-container">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['class' => 'center-content'],
                'contentOptions' => ['class' => 'center-content'],
            ],

            [
                // See more options In http://www.yiiframework.com/doc-2.0/yii-grid-datacolumn.html
                'attribute' => 'name',
                'headerOptions' => ['class' => 'center-content'],
                'value' => 'name',
                'enableSorting' => true,
            ],
            [
                'attribute' => 'short_name',
                'headerOptions' => ['class' => 'center-content'],
                'value' => 'short_name',
                'enableSorting' => true,
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['class' => 'center-content'],
                'contentOptions' => ['class' => 'center-content'],
            ],
        ],
        'panel'=>[
            'type' => GridView::TYPE_PRIMARY.' no-margin no-border-radius',
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> '.Html::encode($this->title).'</h3>',
            'headingOptions' => ['class' => 'no-border-radius'],
            'before' => '<div class="clearfix"></div>'
                        .$this->render('_search', ['model' => $searchModel])
                        .Html::a('<i class="glyphicon glyphicon-plus"></i> Create Languages', ['create'], ['class' => 'btn btn-success']),
        ],
    ]); ?>
</div>
