<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CttJournals */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ctt Journals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctt-journals-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id, 'lang_id' => $model->lang_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id, 'lang_id' => $model->lang_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
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
            'alias_id',
            'name',
            'name_fulltext:ntext',
            'abbrev_name',
            'issn',
            'eissn',
            'isbn',
            'coverage',
            'editor',
            'open_status',
            'access_status',
            'source_type_id',
            'source_type',
            'print_lang',
            'volume_per_year',
            'issue_per_volume',
            'history_indication_id',
            'history_indication',
            'address',
            'country_id',
            'phone',
            'fax',
            'email:email',
            'website',
            'publisher_id',
            'subjectarea_class',
            'organization_id',
            'organization',
            'status',
            'created_by',
            'created_dtm',
            'modified_by',
            'modified_dtm',
        ],
    ]) ?>

</div>
