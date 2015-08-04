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
    $footer = Html::a('<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> '
                        .Yii::t('app/frontend', 'Back'),
                        Url::to(['index']),
                        ['class' => 'btn btn-danger']);
    if (\Yii::$app->user->can('publisherManagement')) {
        $footer .= ' '.Html::a('<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> '
                        .Yii::t('app/frontend', 'Edit'),
                        Url::to(['update', 'id' => $value->id, 'lang_id' => $value->lang_id]),
                        ['class' => 'btn btn-primary']);
    }

    array_push($items,  [
        'label' => '<i class="glyphicon glyphicon-book"></i> '.$value->lang,
        'content' => DetailView::widget([
                        'model' => $value,
                        'attributes' => [
                            'id',
                            'lang',
                            'aliasid',
                            'name',
                            'name_fulltext',
                            'main_publisher',
                            'address',
                            'country',
                            'phone',
                            'fax',
                            'website',
                            'email',
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
                            'footer' => $footer,
                            'footerOptions' => [
                                'tag' => 'div',
                            ],
                        ],
                        'buttons1' => '',
                    ])
    ]);
}

echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_ABOVE,
    'bordered'=>true,
    'encodeLabels'=>false
]);

echo '<br><br><br><br><br>List of Journal<br><br><br><br><br><br><br><br><br><br><br><br>';