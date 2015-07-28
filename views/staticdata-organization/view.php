<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataOrganizations */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Staticdata Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-organizations-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'lang_id',
            'lang',
            'affiliation_id',
            'name',
            'alias',
            'address',
            [
                'attribute' => 'status',
                'value' => Yii::$app->params['status'][$model->status]
            ],
            'created_by',
            'created_dtm',
            'modified_by',
            'modified_dtm',
        ],
        'panel' => [
            'heading' => $model->name,
            'type' => DetailView::TYPE_PRIMARY,
            'footer' => Html::a('<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> '
                                .Yii::t('app/frontend', 'Back'),
                                ['lang-list', 'id' => $model->id],
                                ['class' => 'btn btn-danger']),
            'footerOptions' => [
                'tag' => 'div'
            ],
        ],
        'buttons1' => '{update}',
        'updateOptions' => [
            'label' => '<a class="update-link" href="'
                        .Url::to([
                                    'update',
                                    'id' => $model->id,
                                    'lang_id' => $model->lang_id,
                                ])
                        .'"><span class="glyphicon glyphicon-pencil"></span></a>'
        ],
    ]) ?>

</div>
