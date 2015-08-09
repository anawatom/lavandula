<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CttPublishersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="tab-content list-of-journal-container">

    <?php
        // https://github.com/yiisoft/yii2/issues/7240
        // $dataProvider = new ActiveDataProvider([
        //     'query' => $model->getCttJournals(),
        // ]);

        echo $journalContent = GridView::widget([
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
                    'attribute' => 'issn',
                    'headerOptions' => ['class' => 'center-content'],
                    'value' => 'issn',
                    'enableSorting' => true,
                ],
                [
                    'attribute' => 'name',
                    'headerOptions' => ['class' => 'center-content'],
                    'format' => 'raw',
                    'value' => function($model) {
                        return Html::a($model->name, ['journal/view', 'id' => $model->id, 'lang_id' => $model->lang_id]);
                    },
                    'enableSorting' => true,
                ],
                [
                    'attribute' => 'country_id',
                    'headerOptions' => ['class' => 'center-content'],
                    'label' => Yii::t('app/ctt_staticdata_country', 'Country'),
                    'value' => function($model) {
                        return $model->country->name;
                    },
                    'enableSorting' => true,
                ],
                [
                    'attribute' => 'email',
                    'headerOptions' => ['class' => 'center-content'],
                    'format' => 'email',
                    'value' => 'email',
                    'enableSorting' => true,
                ],
                [
                    'attribute' => 'website',
                    'headerOptions' => ['class' => 'center-content'],
                    'format' => 'url',
                    'enableSorting' => true,
                ],
            ],
            'panel'=>[
                'type' => GridView::TYPE_PRIMARY.' no-margin no-border-radius',
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> List of Journal</h3>',
                'headingOptions' => ['class' => 'no-border-radius'],
                ],
            ]);
    ?>

</div>
