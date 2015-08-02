<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\CttStaticdataLanguages;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CttStaticdataCountrys */
/* @var $form yii\widgets\ActiveForm */

$currentUser = \Yii::$app->user->getIdentity ();
$cttStaticdataLanguage = CttStaticdataLanguages::find ()->orderBy ( 'id' )->asArray ()->all ();
?>

<?php

$form = ActiveForm::begin ( [ 
		'action' => [ 
				'/articles/' . $mode 
		],
		'method' => 'post',
		'layout' => 'horizontal',
		'fieldConfig' => [ 
				'template' => "{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
				'horizontalCssClasses' => [ 
						'offset' => '',
						'label' => '',
						'wrapper' => 'col-md-12',
						'error' => '',
						'hint' => '' 
				] 
		] 
] );
?>
<div class="panel panel-primary">

	<div class="panel-heading">
		<h3 class="panel-title">Article Details</h3>
	</div>
	<div class="panel-body">
		<div class="form-group">
			<div class="col-md-2" style="text-align: right;">
				<label style="padding-top: 8px;"><?php echo $model->getAttributeLabel('lang'); ?></label>
			</div>
			<div class="col-sm-2"><?=$form->field($model, 'lang_id')->textInput()?>
			    </div>
			<div class="col-md-2" style="text-align: right;">
				<label style="padding-top: 8px;"><?php echo $model->getAttributeLabel('documenttype'); ?></label>
			</div>
			<div class="col-sm-2"><?=$form->field($model, 'documenttype_id')->textInput()?>
			    </div>

		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>

