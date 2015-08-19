<?php 
	use yii\helpers\Url;
	use yii\helpers\Html;
	use yii\helpers\ArrayHelper;
	use yii\bootstrap\ActiveForm;
	use kartik\select2\Select2;
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
.remove-row-button {
	cursor: pointer;
}
.remove-row-button:hover {
	text-decoration: none;
}
</style>
<?php
	$form = ActiveForm::begin([
		'action' => ['articles/importer'],
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
						<?= $form->field($model, 'docsource_id')
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
						<?php //$form->field($model, 'authors', [
						//	'template' => "{label}\n{beginWrapper}\n{endWrapper}",
						//	'horizontalCssClasses' => [
						//								'offset' => '',
						//								'label' => 'col-md-3',
						//								'wrapper' => 'col-md-9 authors-input-container',
						//								'error' => '',
						//								'hint' => '',
						//							],
						//	]) ?>
						<div class="form-group field-articleimporter-authors">
							<label class="control-label col-md-3" for="articleimporter-authors">Authors</label>
							<div class="col-md-9">
								<div class="col-md-12 authors-input-container"></div>
								<div class="col-md-12">
									<a class="btn btn-primary add-author-button">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										<?= Yii::t('app/article_importer', 'Add Author') ?>
									</a>
								</div>
							</div>
						</div>
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
								->widget(Select2::classname(), [
									'data' => ArrayHelper::map($cttStaticdataSubjectareaClass, 'id', 'name', 'subjectarea.name'),
									'options' => [],
									'pluginOptions' => [
										'allowClear' => true
									],
								]) ?>
						<?= $form->field($model, 'journal_id')
								->widget(Select2::classname(), [
									'data' => ArrayHelper::map($cttJournals, 'id', 'name'),
									'options' => [],
									'pluginOptions' => [
										'allowClear' => true
									],
								]) ?>
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
								<?= Html::submitButton('<span class="glyphicon glyphicon-save" aria-hidden="true"></span> '.Yii::t('app/frontend', 'Save'),
														['class' => 'btn btn-primary']) ?>
								<?= Html::a('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> '.Yii::t('app/frontend', 'Reset'),
											Url::to(['staticdata-countrys/index']),
											['class' => 'btn btn-danger']) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>

<div id="authors_template" class="hidden">
	<div class="form-group authors-input-form-group">
		<div class="col-md-12 content-right">
			<a class="remove-row-button">[-]</a>
		</div>
		<div class=" field-authors-name col-md-12">
			<label class="control-label col-md-1" for="authors-name">Name</label>
			<div class="col-md-2">
				<input type="text" class="form-control" name="ArticleImporter[authors][name][]" value="">
				<div class="help-block help-block-error "></div>
			</div>
			<label class="control-label col-md-1" for="authors-organization">Org.</label>
			<div class="col-md-2">
				<input type="text" class="form-control" name="ArticleImporter[authors][organization][]" value="">
				<div class="help-block help-block-error "></div>
			</div>
			<label class="control-label col-md-1" for="authors-affiliation">Affi.</label>
			<div class="col-md-2">
				<input type="text" class="form-control" name="ArticleImporter[authors][affiliation][]" value="">
				<div class="help-block help-block-error "></div>
			</div>
			<label class="control-label col-md-1" for="authors-address">Addr.</label>
			<div class="col-md-2">
				<input type="text" class="form-control" name="ArticleImporter[authors][address][]" value="">
				<div class="help-block help-block-error "></div>
			</div>
		</div>
	</div>
</div>

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

	function addAuthorInput() {
		var $authorsInputContainer = $('.authors-input-container');
		var $authorsTemplate = $('#authors_template');

		$authorsInputContainer.append($authorsTemplate.html());
		$authorsInputContainer
		.find('.remove-row-button:last')
		.on('click', function() {
			var $this = $(this);
			$this.closest('.authors-input-form-group').remove();
		});
	}

	$(function() {
		$('.add-author-button').on('click', function() {
			addAuthorInput()
		}).trigger('click');

		// TODO:: Need to refactor later
		$('input[name="ArticleImporter[authors][name][]"').val('<?= $model->authors ?>');
		if ('<?= $model->title_en ?>'.length) {
			setTimeout(function() {
				$('button[type="submit"]').trigger('click');
			}, 5000);
		}
	})
</script>