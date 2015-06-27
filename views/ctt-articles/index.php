<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ctt Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-articles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ctt Articles', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'lang_id',
            'lang',
            'documenttype_id',
            'documenttype',
            // 'docsource_id',
            // 'docsource',
            // 'alias_id',
            // 'title',
            // 'abbrev_title',
            // 'title_fulltext:ntext',
            // 'year',
            // 'journal_d',
            // 'publisher_id',
            // 'journal',
            // 'volume',
            // 'issue_id',
            // 'artnumber',
            // 'page_start',
            // 'page_end',
            // 'page_count',
            // 'cited',
            // 'doi',
            // 'link',
            // 'affiliation_id',
            // 'affiliation',
            // 'abstract:ntext',
            // 'author_keyword:ntext',
            // 'auto_keyword:ntext',
            // 'funding',
            // 'correspondence',
            // 'sponsors',
            // 'codenid',
            // 'pubmedid',
            // 'checksum',
            // 'created_by',
            // 'created_dtm',
            // 'modified_by',
            // 'modified_dtm',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
