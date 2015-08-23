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
<div style="clear:both;"></div>
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
						<?php // $form->field($model, 'abbrev_title_en') ?>
						<?= $form->field($model, 'title_local') ?>
						<?php // $form->field($model, 'abbrev_title_local') ?>
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
						<?php // $form->field($model, 'correspondence') ?>
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
		<div class=" field-authors-name col-md-12">
			<label class="control-label col-md-2" for="authors-name">Main Author</label>
			<div class="col-md-1">
				<input type="checkbox" class="" name="ArticleImporter[authors][main][]" value="">
				<div class="help-block help-block-error"></div>
			</div>
			<label class="control-label col-md-1" for="authors-name">Name</label>
			<div class="col-md-2">
				<input type="text" class="form-control" name="ArticleImporter[authors][name][]" value="">
				<div class="help-block help-block-error"></div>
			</div>
			<label class="control-label col-md-1" for="authors-organization">Org.</label>
			<div class="col-md-4">
				<div class="input-group">
					<?php
						echo Select2::widget([
									'model' => $model,
									'name' => 'ArticleImporter[authors][organization][]',
									'data' => ArrayHelper::map($cttStaticdataOrganizations, 'id', 'name_full'),
									'options' => [
													'class' => 'form-control'
												],
									'pluginOptions' => [
										'allowClear' => true
									],
									'addon' => [
												'append' => [
													'content' => Html::button('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
																				[
																					'class' => 'btn btn-primary',
																					'title' => 'Add Affiliation',
																					'data-toggle' => 'tooltip'
																				]),
													'asButton' => true
												]
									]
								]);
					?>
				</div>
				<div class="help-block help-block-error"></div>
			</div>
			<div class="col-md-1 content-right">
				<a class="btn btn-danger remove-row-button">
					<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
				</a>
			</div>
			<!-- <label class="control-label col-md-1" for="authors-affiliation">Affi.</label>
			<div class="col-md-2">
				<input type="text" class="form-control" name="ArticleImporter[authors][affiliation][]" value="">
				<div class="help-block help-block-error "></div>
			</div>
			<label class="control-label col-md-1" for="authors-address">Addr.</label>
			<div class="col-md-2">
				<input type="text" class="form-control" name="ArticleImporter[authors][address][]" value="">
				<div class="help-block help-block-error "></div>
			</div> -->
		</div>
	</div>
</div>

<script type="text/javascript">
	var authors = <?= json_encode($model->authors) ?>;
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

	function addAuthorInput(data) {
		var $authorsInputContainer = $('.authors-input-container');
		var $authorsTemplate = $('#authors_template');

		var $authorsInputFormGroup = $authorsInputContainer
										.append($authorsTemplate.html())
										.find('.authors-input-form-group:last');
		$authorsInputFormGroup
		.find('.remove-row-button')
		.on('click', function() {
			var $this = $(this);
			$this.closest('.authors-input-form-group').remove();
		});

		if (data) {
			if (data.name) {
				$authorsInputFormGroup
				.find('input[name="ArticleImporter[authors][name][]"]')
				.val(data.name);
			}
			if (data.organization) {
				$authorsInputFormGroup
				.find('select[name="ArticleImporter[authors][organization][]"]')
				.val(data.organization);
			}
		}

		// Reinitialize select2
		var $select2El = $authorsInputFormGroup.find('select[name="ArticleImporter[authors][organization][]"]'),
				settings = $select2El.attr('data-krajee-select2');
		settings = window[settings];
		$select2El.select2(settings);
	}

	$(function() {
		if (authors) {
			$.each(authors, function(key, value) {
				addAuthorInput(value);
			});
		} else {
			addAuthorInput();
		}

		$('.add-author-button').on('click', function() {
			addAuthorInput();
		});
	})
</script>