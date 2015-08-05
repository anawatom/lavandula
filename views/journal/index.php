<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CttJournalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ctt Journals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-journals-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ctt Journals'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'lang_id',
            'lang',
            'alias_id',
            'name',
            // 'name_fulltext:ntext',
            // 'abbrev_name',
            // 'issn',
            // 'eissn',
            // 'isbn',
            // 'coverage',
            // 'editor',
            // 'open_status',
            // 'access_status',
            // 'source_type_id',
            // 'source_type',
            // 'print_lang',
            // 'volume_per_year',
            // 'issue_per_volume',
            // 'history_indication_id',
            // 'history_indication',
            // 'address',
            // 'country_id',
            // 'phone',
            // 'fax',
            // 'email:email',
            // 'website',
            // 'publisher_id',
            // 'subjectarea_class',
            // 'organization_id',
            // 'organization',
            // 'status',
            // 'created_by',
            // 'created_dtm',
            // 'modified_by',
            // 'modified_dtm',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
