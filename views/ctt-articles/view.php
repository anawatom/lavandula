<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CttArticles */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Ctt Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-articles-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'lang_id' => $model->lang_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'lang_id' => $model->lang_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'lang_id',
            'lang',
            'documenttype_id',
            'documenttype',
            'docsource_id',
            'docsource',
            'alias_id',
            'title',
            'abbrev_title',
            'title_fulltext:ntext',
            'year',
            'journal_d',
            'publisher_id',
            'journal',
            'volume',
            'issue_id',
            'artnumber',
            'page_start',
            'page_end',
            'page_count',
            'cited',
            'doi',
            'link',
            'affiliation_id',
            'affiliation',
            'abstract:ntext',
            'author_keyword:ntext',
            'auto_keyword:ntext',
            'funding',
            'correspondence',
            'sponsors',
            'codenid',
            'pubmedid',
            'checksum',
            'created_by',
            'created_dtm',
            'modified_by',
            'modified_dtm',
        ],
    ]) ?>

</div>
