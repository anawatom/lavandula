<?php 
	use yii\helpers\Url;
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
?>
<style type="text/css">
div.head{
	margin: 7px 0;
	text-align: right;
}
div.row.custom1{
	padding: 5px 0;
}
div.row label{
	padding: 0 10px 0 5px;
}
</style>
<?php $form = ActiveForm::begin([
	'action' => ['/articles/importer'],
	'method' => 'post',
	'layout' => 'horizontal',
	'fieldConfig' => [
	'template' => "{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
	'horizontalCssClasses' => [
								'offset' => '',
								'label' => '',
								'wrapper' => 'col-md-12',
								'error' => '',
								'hint' => '',
							],
	]
]); ?>

<div style="clear:both;padding:10px 0;"></div>
<div class="row content">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-warning dummy-data">
					<div class="panel-heading">
						<h3 class="panel-title">Metadata Extractor</h3>
					</div>
					<div class="panel-body">
						<div class="row custom1">
							<div class="col-md-2 head">
								PDF File Browse
							</div>
							<div class="col-md-4">
								<input type="file" name="uploadFile" class="form-control"/>
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								Template Name
							</div>
							<div class="col-md-4">
								<select name="template" class="form-control">
									<option value="">Journal Of Community Development Research</option>
									<option value="">Journal Of Community Development Research2</option>
								</select>
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-12 center-content">
								<input type="hidden" name="action" value="metadataextractor" />
								<button class="btn-success">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
	
	
	
<?php ActiveForm::end(); ?>