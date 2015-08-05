<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CttPublishersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="tab-content list-of-journal-container" data-publisher-id="<?= $model->id ?>">

    <?php
        // https://github.com/yiisoft/yii2/issues/7240
        $dataProvider = new ActiveDataProvider([
            'query' => $model->getCttJournals(),
        ]);

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
                    'value' => 'name',
                    'enableSorting' => true,
                ],
                [
                    'attribute' => 'country_id',
                    'headerOptions' => ['class' => 'center-content'],
                    'value' => 'country_id',
                    'enableSorting' => true,
                ],
                [
                    'attribute' => 'email',
                    'headerOptions' => ['class' => 'center-content'],
                    'value' => 'website',
                    'enableSorting' => true,
                ],
                [
                    'attribute' => 'email',
                    'headerOptions' => ['class' => 'center-content'],
                    'value' => 'website',
                    'enableSorting' => true,
                ],
            ],
            'panel'=>[
                'type' => GridView::TYPE_PRIMARY.' no-margin no-border-radius',
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> List of Journam</h3>',
                'headingOptions' => ['class' => 'no-border-radius'],
                ],
            ]);
    ?>

</div>
