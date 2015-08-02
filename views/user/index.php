<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/user', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

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
                'attribute' => 'role',
                'headerOptions' => ['class' => 'center-content'],
                'value' => function($model) {
                    return $model->role->name;
                },
                'enableSorting' => true,
            ],
            [
                'attribute' => 'username',
                'headerOptions' => ['class' => 'center-content'],
                'value' => 'username',
                'enableSorting' => true,
            ],
            [
                'attribute' => 'password',
                'headerOptions' => ['class' => 'center-content'],
                'value' => function($model) {
                    return '********';
                },
                'enableSorting' => true,
            ],
            [
                'attribute' => 'status',
                'headerOptions' => ['class' => 'center-content'],
                'value' => function($model) {
                    return Yii::$app->params['status'][$model->status];
                },
                'enableSorting' => true,
            ],
            [
                'attribute' => 'login_time',
                'headerOptions' => ['class' => 'center-content'],
                'value' => 'login_time',
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
                        .$this->render('_search', ['model' => $searchModel, 'roles' => $roles])
                        .Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('app/user', 'Create User'),
                                ['create'],
                                ['class' => 'btn btn-success']),
            ],
        ]);
    ?>

</div>
