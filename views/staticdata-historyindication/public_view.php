<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\tabs\TabsX;
use kartik\detail\DetailView;

$this->title = $model[0]->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_affiliation', 'Ctt Staticdata Affiliations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$items = [];

foreach ($model as $key => $value) {
    array_push($items,  [
        'label' => '<i class="glyphicon glyphicon-book"></i> '.$value->lang,
        'content' => DetailView::widget([
                        'model' => $value,
                        'attributes' => [
                            'id',
                            'lang',
                            'name',
                            [
                                'attribute' => 'status',
                                'value' => Yii::$app->params['status'][$value->status],
                            ],
                            'created_by',
                            'created_dtm',
                            'modified_by',
                            'modified_dtm',
                        ],
                        'panel' => [
                            'heading' => $value->name,
                            'type' => DetailView::TYPE_PRIMARY,
                            'footer' => Html::a('<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> '
                                            .Yii::t('app/frontend', 'Back'),
                                            Url::to(['index']),
                                            ['class' => 'btn btn-danger']),
                            'footerOptions' => [
                                'tag' => 'div'
                            ],
                        ],
                        'buttons1' => '',
                    ])
    ]);
}

echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_LEFT,
    'bordered'=>true,
    'encodeLabels'=>false
]);