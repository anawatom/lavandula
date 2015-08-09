<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\tabs\TabsX;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use app\models\CttJournals;

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
        /***
        * Not working when send by POST type
        *   See in
        *   https://github.com/yiisoft/yii2/issues/2881
        */
        $footer .= ' '.Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> '
                        .Yii::t('app/frontend', 'Delete'),
                        ['delete', 'id' => $value->id, 'lang_id' => $value->lang_id],
                        [
                            'class' => 'btn btn-danger delete-button',
                            'title' => Yii::t('app/frontend', 'Delete'),
                            'data-confirm' => Yii::t('app/frontend', 'Are you sure to delete this item?'),
                        ]);
    }

    array_push($items,  [
        'headerOptions' => [
            'class' => 'publisher-tabs',
            'data-publisher-id' => $value->id
        ],
        'label' => '<i class="glyphicon glyphicon-book"></i> '.$value->lang,
        'content' => DetailView::widget([
                        'model' => $value,
                        'attributes' => [
                            'name',
                            'main_publisher',
                            'address',
                            'country',
                            'phone',
                            'fax',
                            'website',
                            'email',
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

// Add button to create the another language data
if (Yii::$app->user->can('publisherManagement')) {
  array_push($items, [
        'headerOptions' => [
            'class' => 'publisher-tabs',
        ],
        'url' => Url::to(['create', 'id' => $model[0]->id]),
        'label' => '<i class="glyphicon glyphicon-plus"></i> '.Yii::t('app/frontend', 'Add new language')
        ]);
}

echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_ABOVE,
    'bordered'=>false,
    'encodeLabels'=>false
]);

$journalContent = $this->render('_journal_list', ['dataProvider' => $cttJournals]);
echo $journalContent;
?>