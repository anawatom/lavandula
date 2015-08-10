<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CttPublishers */
/* @var $form yii\widgets\ActiveForm */

$id = Yii::$app->request->getQueryParam('id');
if (empty($id)) {
    $backUrl = Url::to(['index']);
} else {
    $backUrl = Url::to(['public-view', 'id' => $id]);
}

echo DetailView::widget([
    'model'=> $model,
    'condensed' => true,
    'hover' => true,
    'mode' => ($mode == 'create')? DetailView::MODE_EDIT: DetailView::MODE_EDIT,
    'panel'=>[
        'heading' => $title,
        'type' => DetailView::TYPE_PRIMARY,
        'footer' => Html::a('<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> '
                            .Yii::t('app/frontend', 'Back'),
                            $backUrl,
                            ['class' => 'btn btn-danger']),
        'footerOptions' => [
            'tag' => 'div'
        ],
    ],
    'attributes' => [
        [
            'label' => Yii::t('app/ctt_publisher', 'Revision'),
            'value' => '',
            'visible' => ($mode == 'edit')? true: false,
            'rowOptions' => [
                'id' => 'revisionRows',
            ]
        ],
        [
            'attribute' => 'lang_id',
            'label' => Yii::t('app/backend', 'Lang'),
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions'=>[
                'data' => ArrayHelper::map($cttStaticdataLanguages, 'id', 'name'),
                'options' => [],
                'pluginOptions' => ['allowClear' => true, 'width' => '100%'],
                'pluginEvents' => [
                    'change' => 'function() { $("#cttpublishers-lang").val( $(this).find("option:selected").text() ); }',
                ],
            ],
        ],
        [
            'attribute' => 'lang',
            'type' => DetailView::INPUT_HIDDEN,
            'options' => [
                'value' => ($mode == 'create')? $cttStaticdataLanguages[0]['name']: $model->lang,
            ],
        ],
        [
            'attribute' => 'aliasid',
            'options' => [
            ],
        ],
        [
            'attribute' => 'name',
            'options' => [
            ],
        ],
        [
            'attribute' => 'name_fulltext',
            'options' => [
            ],
        ],
        [
            'attribute' => 'main_publisher',
            'options' => [
            ],
        ],
        [
            'attribute' => 'address',
            'type' => DetailView::INPUT_TEXTAREA,
            'options' => [
            ],
        ],
        [
            'attribute' => 'country_id',
            'label' => Yii::t('app/ctt_publisher', 'Country'),
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions'=>[
                'data' => ArrayHelper::map($cttStaticdataCountrys, 'id', 'name'),
                'options' => [],
                'pluginOptions' => ['allowClear' => true, 'width' => '100%'],
                'pluginEvents' => [
                ],
            ],
        ],
        [
            'attribute' => 'country',
            'type' => DetailView::INPUT_HIDDEN,
            'options' => [
                'value' => ($mode == 'create')? $cttStaticdataCountrys[0]['name']: $model->lang,
            ],
        ],
        [
            'attribute' => 'phone',
            'options' => [
            ],
        ],
        [
            'attribute' => 'fax',
            'options' => [
            ],
        ],
        [
            'attribute' => 'website',
            'options' => [
            ],
        ],
        [
            'attribute' => 'email',
            'options' => [
            ],
        ],
        [
            'attribute' => 'status',
            'type' => DetailView::INPUT_SELECT2 ,
            'widgetOptions'=>[
                'data' => Yii::$app->params['status'],
                'options' => [],
                'pluginOptions' => ['allowClear' => true, 'width' => '100%'],
                'pluginEvents' => [
                ],
            ],
        ],
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
        'label' => '<span class="glyphicon glyphicon-ban-circle"></span>',
    ],
    // 'deleteOptions' => [
    //     'label' => Html::a('<span class="glyphicon glyphicon-remove"></span> '
    //                     .Yii::t('app/frontend', 'Delete'),
    //                     ['delete', 'id' => $model->id, 'lang_id' => $model->lang_id],
    //                     [
    //                         'class' => 'btn btn-danger delete-button',
    //                         'title' => Yii::t('app/frontend', 'Delete'),
    //                         'data-method' => 'post',
    //                     ]),
    // ],
    'i18n' => [
        'class' => 'yii\i18n\PhpMessageSource',
        'basePath' => '@app/messages',
        'forceTranslation' => true
    ]
]);
?>

<?php if ($mode == 'edit') : ?>
    <?php
        $htmlRevision = '<select id="revisionType" class="form-control" name="revision_type">';
        foreach ($revisions as $key => $value) {
            $htmlRevision .= '<option value="'.$key.'">'.$value.'</option>';
        }
        $htmlRevision .= '</select>';
    ?>
    <script>
        $(function() {
            $('#revisionRows .kv-form-attribute').html('<div class="input-group input-group-md"><?= $htmlRevision ?></div>');
        })
    </script>
<?php endif ?>
