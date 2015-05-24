<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use himiklab\jqgrid\JqGridWidget;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */


?>


<?= JqGridWidget::widget([
    'requestUrl' => 'site/contact',
    'gridSettings' => [
        'colNames' => ['Title', 'Author', 'Language'],
        'colModel' => [
            ['name' => 'title', 'index' => 'title', 'editable' => true],
            ['name' => 'author', 'index' => 'author', 'editable' => true],
            ['name' => 'language', 'index' => 'language', 'editable' => true]
        ],
        'rowNum' => 15,
        'autowidth' => true,
        'height' => 'auto',
    ],
    'pagerSettings' => [
        'edit' => true,
        'add' => true,
        'del' => true,
        'search' => ['multipleSearch' => true]
    ],
    'enableFilterToolbar' => true
]); ?>