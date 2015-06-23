<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CttPublishersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ctt Publishers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-publishers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ctt Publishers'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'lang_id',
            'lang',
            'aliasid',
            'name:ntext',
            // 'main_publisher',
            // 'editor',
            // 'address',
            // 'country_id',
            // 'country',
            // 'phone',
            // 'website',
            // 'email:email',
            // 'created_by',
            // 'created_dtm',
            // 'modified_by',
            // 'modified_dtm',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
