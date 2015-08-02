<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CttArticles */

$this->title = Yii::t('app/ctt_article', 'Create New Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_article', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/ctt_article', 'Articles (Language List)'),
									'url' => ['lang-list', 'id' => Yii::$app->request->getQueryParam('id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <?= $this->render('_form', [
		'title' => Html::encode($this->title),
        'model' => $model,
        'mode' => 'create',
    ]) ?>

</div>
