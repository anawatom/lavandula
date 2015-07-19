<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CttStaticdataCountrysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/ctt_staticdata_docsource', 'Ctt Staticdata Countrys(Language List)');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_docsource', 'Ctt Staticdata Docsources'), 'url' => ['index']];
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
            ],
        ],
        'panel'=>[
        'type' => GridView::TYPE_PRIMARY.' no-margin no-border-radius',
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> '.Html::encode($this->title).'</h3>',
        'headingOptions' => ['class' => 'no-border-radius'],
        'before' => '<div class="clearfix"></div>'
                    .Html::a('<i class="glyphicon glyphicon-plus"></i> '
                            .Yii::t('app/frontend', 'Add new language'),
                            ['create', 'id' => Yii::$app->request->getQueryParam('id')],
                            ['class' => 'btn btn-success']),
        ],
    ]); ?>

</div>
