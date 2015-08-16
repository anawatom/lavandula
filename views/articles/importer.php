<?php 
	use yii\helpers\Url;
	use yii\helpers\Html;
	use yii\helpers\ArrayHelper;
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
div.cke_show_borders{
	padding: 5px;
	border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
</style>
<?php
	$form = ActiveForm::begin([
		'action' => ['/article/importer-submit'],
		'method' => 'post',
		'layout' => 'horizontal',
		'fieldConfig' => [
		'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
		'horizontalCssClasses' => [
									'offset' => '',
									'label' => 'col-md-3',
									'wrapper' => 'col-md-9',
									'error' => '',
									'hint' => '',
								],
		]
	]);

?>
<div style="clear:both;padding:10px 0;"></div>
<div class="row content">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-warning dummy-data">
					<div class="panel-heading">
						<h3 class="panel-title">Article Details</h3>
					</div>
					<div class="panel-body">
						<?= $form->field($model, 'lang_id')
								->dropDownList(ArrayHelper::map($cttStaticdataLanguages, 'id', 'name')) ?>
						<?= $form->field($model, 'documenttype_id')
								->dropDownList(ArrayHelper::map($cttStaticdataDocumenttypes, 'id', 'name')) ?>
						<?= $form->field($model, 'docsources')
								->inline()
								->checkboxList(ArrayHelper::map($cttStaticdataDocsources, 'id', 'name'),
												[
													'itemOptions' => [
																	'class' => ''
																]
												]) ?>
						<?= $form->field($model, 'title_en') ?>
						<?= $form->field($model, 'abbrev_title_en') ?>
						<?= $form->field($model, 'title_local') ?>
						<?= $form->field($model, 'abbrev_title_local') ?>
						<?= $form->field($model, 'author_keyword_en') ?>
						<?= $form->field($model, 'author_keyword_local') ?>
						<?= $form->field($model, 'abstract_en')
								->textArea([
									'options' => [
									]
								]) ?>
						<?= $form->field($model, 'abstract_local')
								->textArea([
									'options' => [
									]
								]) ?>
						<?= $form->field($model, 'authors') ?>
						<div class="form-group">
							<?= $form->field($model, 'doi', [
								'options' => [
									'class' => '',
								],
								'horizontalCssClasses' => [
															'offset' => '',
															'label' => 'col-md-3',
															'wrapper' => 'col-md-3',
															'error' => '',
															'hint' => '',
														],
								]) ?>
							<?= $form->field($model, 'link',
								[
								'options' => [
									'class' => '',
								],
								'horizontalCssClasses' => [
															'offset' => '',
															'label' => 'col-md-2',
															'wrapper' => 'col-md-4',
															'error' => '',
															'hint' => '',
														],
								]) ?>
						</div>
						<?= $form->field($model, 'funding') ?>
						<?= $form->field($model, 'correspondence') ?>
						<?= $form->field($model, 'sponsors') ?>
						<?= $form->field($model, 'codenid') ?>
						<?= $form->field($model, 'pubmedid') ?>
						<?= $form->field($model, 'subjectarea_class')
								->dropDownList(ArrayHelper::map($cttStaticdataSubjectareas, 'id', 'name')) ?>
						<?= $form->field($model, 'journal_id')
								->dropDownList(ArrayHelper::map($cttJournals, 'id', 'name')) ?>
						<div class="form-group">
							<?= $form->field($model, 'year', [
								'options' => [
									'class' => '',
								],
								'horizontalCssClasses' => [
															'offset' => '',
															'label' => 'col-md-3',
															'wrapper' => 'col-md-2',
															'error' => '',
															'hint' => '',
														],
								]) ?>
							<?= $form->field($model, 'volume', [
								'options' => [
									'class' => '',
								],
								'horizontalCssClasses' => [
															'offset' => '',
															'label' => 'col-md-1',
															'wrapper' => 'col-md-2',
															'error' => '',
															'hint' => '',
														],
								]) ?>
							<?= $form->field($model, 'year_no', [
								'options' => [
									'class' => '',
								],
								'horizontalCssClasses' => [
															'offset' => '',
															'label' => 'col-md-2',
															'wrapper' => 'col-md-2',
															'error' => '',
															'hint' => '',
														],
								]) ?>
						</div>
						<?= $form->field($model, 'artnumber') ?>
						<div class="form-group">
							<?= $form->field($model, 'page_start', [
								'options' => [
									'class' => '',
								],
								'horizontalCssClasses' => [
															'offset' => '',
															'label' => 'col-md-3',
															'wrapper' => 'col-md-2',
															'error' => '',
															'hint' => '',
														],
								]) ?>
							<?= $form->field($model, 'page_end', [
								'options' => [
									'class' => '',
								],
								'horizontalCssClasses' => [
															'offset' => '',
															'label' => 'col-md-1',
															'wrapper' => 'col-md-2',
															'error' => '',
															'hint' => '',
														],
								]) ?>
							<?= $form->field($model, 'page_count', [
								'options' => [
									'class' => '',
								],
								'horizontalCssClasses' => [
															'offset' => '',
															'label' => 'col-md-2',
															'wrapper' => 'col-md-2',
															'error' => '',
															'hint' => '',
														],
								]) ?>
						</div>
						<div class="form-group">
							<div class="col-md-offset-4 col-md-4">
								<?= Html::submitButton(Yii::t('app/frontend', 'Save'), ['class' => 'btn btn-primary']) ?>
								<?= Html::a(Yii::t('app/frontend', 'Reset'), Url::to(['staticdata-countrys/index']), ['class' => 'btn btn-danger']) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>

<script type="text/javascript">
// 	var exampleContainer = document.getElementById('example');
	
// 	if (exampleContainer.innerHTML.trim().length == 0) {
// 		exampleContainer.innerHTML = document.getElementById('exampleContent').innerHTML;
// 	}
	
	CKEDITOR.config.toolbar_Full =
	[
		{ name: 'document', items : [ 'Source'] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Find'] },
// 		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline'] },
// 		{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight'] },
		{ name: 'basicstyles', items : [] },
		{ name: 'paragraph', items : [] },
// 		{ name: 'wiris', items : [ 'ckeditor_wiris_formulaEditor' ]}
	];			
	
	CKEDITOR.inline('articleimporter-abstract_en', {
		language: 'en',
		toolbar:'Full'
	});
	CKEDITOR.inline('articleimporter-abstract_local', {
		language: 'en',
		toolbar:'Full'				
	});
		
</script>