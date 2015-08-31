<?php 
	use yii\helpers\Url;
	use yii\helpers\Html;
	use yii\helpers\ArrayHelper;
	use yii\bootstrap\ActiveForm;
	use yii\web\JsExpression;
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
									'label' => 'col-md-2',
									'wrapper' => 'col-md-10',
									'error' => '',
									'hint' => '',
								],
		]
	]);
?>
<div style="clear:both;"></div>
<div class="row content">
	<div class="col-md-12">
		<div class="panel panel-warning dummy-data">
			<div class="panel-body">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#metadata" aria-controls="home" role="tab" data-toggle="tab">Metadata</a></li>
					<li role="presentation"><a href="#author" aria-controls="profile" role="tab" data-toggle="tab">Authors</a></li>
					<li role="presentation"><a href="#reference" aria-controls="messages" role="tab" data-toggle="tab">Reference</a></li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="metadata">
						<div class="col-md-12">
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
							<div class="form-group">
								<?= $form->field($model, 'doi', [
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
																'label' => 'col-md-2',
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
																'label' => 'col-md-2',
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
																'label' => 'col-md-2',
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
																'label' => 'col-md-2',
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
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="author">
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
							<div class="col-md-12 authors-input-container"></div>
							<?php if (isset($xml_authors) && isset($xml_affiliations)) : ?>
								<div>
									<textarea class="form-control" rows="10"><?php print_r($xml_authors); print_r($xml_affiliations); ?></textarea>
								</div>
							<?php endif ?>
							<div class="col-md-12">
								<a class="btn btn-primary add-author-button">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									<?= Yii::t('app/article_importer', 'Add Author') ?>
								</a>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="reference">
						<div class="col-md-12 references-input-container"></div>
						<?php if (isset($xml_references)) : ?>
							<div>
								<textarea class="form-control"  rows="20"><?php print_r($xml_references) ?></textarea>
							</div>
						<?php endif ?>
					</div>
				</div>
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

<?php ActiveForm::end(); ?>

<div id="authors_template" class="hidden">
	<div class="form-group authors-input-form-group">
		<div class="field-authors-name col-md-12">
			<label class="control-label col-md-2" for="authors-name">Main Author</label>
			<div class="col-md-1">
				<input type="hidden" class="" name="ArticleImporter[authors][main_author][]" value="20">
				<input type="checkbox" class="main-author-checkbox" data-check="10" data-uncheck="20">
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
									'options' => [
													'class' => 'form-control'
												],
									'pluginOptions' => [
										'allowClear' => true,
										'minimumInputLength' => 3,
										'ajax' => [
											'url' => \yii\helpers\Url::to(['organization-list']),
											'dataType' => 'json',
											'data' => new JsExpression('function(params) { return {q:params.term}; }')
										],
										'templateSelection' => new JsExpression('function(params) {
											$(params.element).attr("data-affiliation-id", params.affiliation_id)
															.attr("data-affiliation-lang-id", params.lang_id);
											return params.text;
										}'),
									],
									'addon' => [
												'append' => [
													'content' => Html::button('<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>',
																				[
																					'class' => 'edit-org-aff-button btn btn-primary',
																					'title' => 'Edit',
																					'data' => [
																						'toggle' => 'tooltip',
																						'placement' => 'top',
																					]
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

<!-- modal #editOrgAff -->
<?= $this->render('_modal_org_aff', []); ?>
<!-- End modal #editOrgAff -->

<div id="references_template" class="hidden">
	<div class="form-group references-input-form-group">
		<div class="row">AAAAA</div>
		<div class="row">AAAAA</div>
		<div class="row">AAAAA</div>
		<div class="row">AAAAA</div>
		<div class="row">AAAAA</div>
	</div>
</div>

<script type="text/javascript">
	var authorsData = <?= json_encode($model->authors) ?>;
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
		$authorsInputFormGroup.attr('data-authors-input-form-group-index', $authorsInputContainer.find('.authors-input-form-group').length);

		// listening events.
		$authorsInputFormGroup
		.find('.remove-row-button')
		.on('click', function() {
			var $this = $(this);
			$this.closest('.authors-input-form-group').remove();
		});
		$authorsInputFormGroup
		.find('.main-author-checkbox')
		.on('change', function() {
			var $this = $(this),
				value;

			if ($this.is(':checked')) {
				value = $this.attr('data-check');
			} else {
				value = $this.attr('data-uncheck');
			}

			$(this).parent()
			.find('input[name="ArticleImporter[authors][main_author][]"]')
			.val(value);
		});
		$authorsInputFormGroup
		.find('.edit-org-aff-button')
		.on('click', function() {
			var $authorsInputFormGroup =$(this)
										.closest('.authors-input-form-group'),
				$selectedOrganization = $authorsInputFormGroup
										.find('select[name="ArticleImporter[authors][organization][]"] option:selected'),
				affiliationId = $selectedOrganization.attr('data-affiliation-id'),
				affiliationLangId = $selectedOrganization.attr('data-affiliation-lang-id'),
				organizationId = $selectedOrganization.val(),
				organizationName = $.trim($selectedOrganization.text()),
				$modal = $('#editOrgAff');

			$modal.find('input').val('');
			$modal.find('input[type="text"]').prop('readonly', true);

			if (affiliationId) {
				$modal.find('.loading-container').show();
				$modal.modal('show');

				$.ajax({
					method: 'GET',
					url: '<?= Url::to(['get-affiliation']); ?>',
					data: {
								id: affiliationId,
								lang_id: affiliationLangId
							}
				})
				.done(function(data, textStatus, jqXHR) {
					$modal.find('input[name="authors_input_form_group_index"]').val($authorsInputFormGroup.attr('data-authors-input-form-group-index'));
					$modal.find('input[name="affiliation_id"]').val(data.id);
					$modal.find('input[name="affiliation_lang_id"]').val(data.lang_id);
					$modal.find('input[name="affiliation_name"]').val(data.name);
					$modal.find('input[name="organization_id"]').val(organizationId);
					$modal.find('input[name="organization_name"]').val(organizationName);

					if (authorsData) {
						$modal.find('#originalData')
							.removeClass('hidden')
							.text(authorsData[$authorsInputFormGroup.attr('data-authors-input-form-group-index')].organization.original_data);
					} else {
						$modal.find('#originalData')
							.addClass('hidden');
					}

					$modal.find('.loading-container').hide();
				})
				.fail(function(jqXHR, textStatus, errorThrown) {
					alert('Get affiliation data failed.');

					$modal.find('.loading-container').hide();
					$modal.modal('hide');
				});
			} else {
				alert('Please select Org.');
			}
		});

		if (data) {
			if (data.name) {
				$authorsInputFormGroup
				.find('input[name="ArticleImporter[authors][name][]"]')
				.val(data.name);
			}
			if (data.organization) {
				reInitSelect2($authorsInputFormGroup.find('select[name="ArticleImporter[authors][organization][]"]'),
								data.organization);
			}
		}

		reInitSelect2($authorsInputFormGroup.find('select[name="ArticleImporter[authors][organization][]"]'), null);
	}

	function reInitSelect2($element, data) {
		var settings = $element.attr('data-krajee-select2');

		if (data) {
			$element.html('<option value="' + data.id + '" data-affiliation-id="' + data.affiliation_id + '" data-affiliation-lang-id="' + data.affiliation_lang_id + '">' + data.name + '</option>');
		}

		settings = window[settings];
		$element.select2(settings);
	}

	$(function() {
		if (authorsData) {
			$.each(authorsData, function(key, value) {
				addAuthorInput(value);
			});
		} else {
			addAuthorInput();
		}

		$('.add-author-button').on('click', function() {
			addAuthorInput();
		});

		// Modal Edit Org./Aff.
		$('#editAffButton').on('click', function() {
			$(this)
				.closest('.form-group')
				.find('input[name="affiliation_name"]')
				.prop('readonly', function(index, value) {
					return !value;
				});
		});
		$('#editOrgButton').on('click', function() {
			$(this)
				.closest('.form-group')
				.find('input[name="organization_name"]')
				.prop('readonly', function(index, value) {
					return !value;
				});
		});
		$('#formEditOrgAff')
		.on('beforeSubmit', function(event) {
			var $this = $(this);
			if (!$this.find('input[name="affiliation_name"]').prop('readonly')
					|| !$this.find('input[name="organization_name"]').prop('readonly')) {
				$.ajax({
					type: 'POST',
					url: $this.attr('action'),
					data: $this.serialize(),
				})
				.done(function(data, textStatus, jqXHR) {
					if (data.flag) {
						reInitSelect2($('.authors-input-form-group[data-authors-input-form-group-index="' + $this.find('input[name="authors_input_form_group_index"]').val() + '"]')
										.find('select[name="ArticleImporter[authors][organization][]"]'),
										{
											id: $this.find('input[name="organization_id"]').val(),
											name: $this.find('input[name="organization_name"]').val(),
											affiliation_id:  $this.find('input[name="affiliation_id"]').val(),
											affiliation_lang_id: $this.find('input[name="affiliation_lang_id"]').val()
										});


						alert(data.message);
					} else {
						alert(data.message);
					}
				})
				.fail(function(jqXHR, textStatus, errorThrown) {
					alert('Save data failed.');
				});
			} else {
				alert('Please click to edit data.');
			}
			return false;
		});
		/** ******************************* */
	});
</script>