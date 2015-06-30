<?php

use yii\helpers\Url;
use kartik\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataLanguages */
/* @var $form yii\widgets\ActiveForm */

$currentUser = \Yii::$app->user->getIdentity();
?>

<?= DetailView::widget([
    'model'=> $model,
    'condensed' => true,
    'hover' => true,
    'mode' => ($mode == 'create')? DetailView::MODE_EDIT: DetailView::MODE_EDIT,
    'panel'=>[
        'heading' => $title,
        'type' => DetailView::TYPE_PRIMARY ,
    ],
    'attributes' => [
        'name',
        'short_name',
        [
			'attribute' => 'created_by',
            'options' => [
                            'readonly' => 'readonly',
                            'value' => $currentUser->email,
                        ],
        ],
        [
			'attribute' => 'modified_by',
            'options' => [
                            'readonly' => 'readonly',
                            'value' => $currentUser->email,
                        ],
        ],
    ],
    'buttons2' => ($mode == 'create')? '{reset}{save}': '{reset}{save}',
    'resetOptions' => [
        'label' => '<span class="glyphicon glyphicon-ban-circle"></span>'
    ],
]);
?>
