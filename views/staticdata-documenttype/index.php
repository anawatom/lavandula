<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CttStaticdataDocumenttypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/ctt_staticdata_documenttype', 'Ctt Staticdata Documenttypes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-documenttypes-index">

     <?= GridView::widget([
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'dataProvider' => $dataProvider,
        'columns' => [
             [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['class' => 'center-content'],
                'contentOptions' => ['class' => 'center-content'],
            ],

            [
                'attribute' => 'lang',
                'headerOptions' => ['class' => 'center-content'],
                'value' => 'lang',
                'enableSorting' => true,
            ],
            [
                'attribute' => 'name',
                'headerOptions' => ['class' => 'center-content'],
                'value' => 'name',
                'enableSorting' => true,
            ],
            [
                'attribute' => 'status',
                'headerOptions' => ['class' => 'center-content'],
                'value' => 'name',
                'enableSorting' => true,
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['class' => 'center-content'],
                'contentOptions' => ['class' => 'center-content'],
                'template'=>'{view} {update}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                                                ['public-view', 'id' => $model->id],
                                                ['title' => Yii::t('app/frontend', 'View')]);
                            },
                    'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                                ['lang-list', 'id' => $model->id],
                                                ['title' => Yii::t('app/frontend', 'Update')]);
                            },
                ],
            ],
        ],
        'panel'=>[
            'type' => GridView::TYPE_PRIMARY.' no-margin no-border-radius',
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> '.Html::encode($this->title).'</h3>',
            'headingOptions' => ['class' => 'no-border-radius'],
            'before' => '<div class="clearfix"></div>'
                        .$this->render('_search', ['model' => $searchModel])
                        .Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('app/ctt_staticdata_documenttype', 'Create Ctt Staticdata Documenttypes'),
                                ['lang-list'],
                                ['class' => 'btn btn-success']),
            ],
        ]);
    ?>

</div>
