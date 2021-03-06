<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataLanguages */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_staticdata_language', 'Ctt Staticdata Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-staticdata-languages-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'short_name',
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
                            Url::to(['index']),
                            ['class' => 'btn btn-danger']),
            'footerOptions' => [
                'tag' => 'div'
            ],
        ],
        'buttons1' => '{update}',
        'updateOptions' => [
            'label' => '<a class="update-link" href="'.Url::to(['update', 'id' => $model->id]).'"><span class="glyphicon glyphicon-pencil"></span></a>'
        ],
    ]) ?>
</div>
