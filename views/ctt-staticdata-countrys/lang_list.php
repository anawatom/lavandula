<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CttStaticdataCountrysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ctt Staticdata Countrys(Language List)');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Countrys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ctt-staticdata-countrys-index">

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
                // See more options In http://www.yiiframework.com/doc-2.0/yii-grid-datacolumn.html
                'attribute' => 'lang',
                'headerOptions' => ['class' => 'center-content'],
                'value' => 'lang',
                'enableSorting' => true,
            ],
            [
                // See more options In http://www.yiiframework.com/doc-2.0/yii-grid-datacolumn.html
                'attribute' => 'name',
                'headerOptions' => ['class' => 'center-content'],
                'value' => 'name',
                'enableSorting' => true,
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
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
                    .Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country',
                            ['create', 'id' => Yii::$app->request->queryParams['id']],
                            ['class' => 'btn btn-success']),
        ],
    ]); ?>

</div>
