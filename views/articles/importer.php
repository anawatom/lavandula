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
<?php $form = ActiveForm::begin([
	'action' => ['/article/importer-submit'],
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
						<h3 class="panel-title">Article Details</h3>
					</div>
					<div class="panel-body">
						<div class="row custom1">
							<div class="col-md-2 head">
								Local Language
							</div>
							<div class="col-md-3">
								<select name="articles[lang_id]" class="form-control">
									<option value="2">Thai</option>
								</select>
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								Document Type
							</div>
							<div class="col-md-3">
								<select name="articles[documenttype_id]" class="form-control">
									<option value="1">Article</option>
								</select>
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								Document Source
							</div>
							<div class="col-md-3">
								<input id="docsource-1" type="checkbox" name="articles[docsources][]" checked="checked" value="1" /><label for="docsource-1">ACI</label>
								<input id="docsource-1" type="checkbox" name="articles[docsources][]" value="2" /><label for="docsource-1">TCI</label>
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								EN Title
							</div>
							<div class="col-md-10">
								<input type="text" name="articles[title_en]" class="form-control" style="width:100%;" />
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								Abbrev EN Title
							</div>
							<div class="col-md-10">
								<input type="text" name="articles[abbrev_title_en]" class="form-control" style="width:100%;" />
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								Local Title
							</div>
							<div class="col-md-10">
								<input type="text" name="articles[title_en]" class="form-control" style="width:100%;" />
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								Abbrev Local Title
							</div>
							<div class="col-md-10">
								<input type="text" name="articles[abbrev_title_en]" class="form-control" style="width:100%;" />
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								EN Abstract
							</div>
							<div class="col-md-10">
								<textarea id="abstract-en" name="articles[abstract_en]"></textarea>
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								Local Abstract
							</div>
							<div class="col-md-10">
								<textarea id="abstract-local" name="articles[title_en]"></textarea>
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								Authors
							</div>
							<div class="col-md-10">
								<input type="text" name="articles[title_en]" class="form-control" data-role="tagsinput" style="width:100%;" />
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								DOI
							</div>
							<div class="col-md-2">
								<input type="text" name="articles[abbrev_title_en]" class="form-control" style="width:100%;" />
							</div>
							<div class="col-md-2 head">
								Fulltext URL
							</div>
							<div class="col-md-6">
								<input type="text" name="articles[link]" class="form-control" style="width:100%;" />
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								Funding Details
							</div>
							<div class="col-md-10">
								<input type="text" name="articles[title_en]" class="form-control" style="width:100%;" />
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								Correspondence Address
							</div>
							<div class="col-md-10">
								<input type="text" name="articles[title_en]" class="form-control" style="width:100%;" />
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								Sponsors
							</div>
							<div class="col-md-10">
								<input type="text" name="articles[title_en]" class="form-control" style="width:100%;" />
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								CODEN ID
							</div>
							<div class="col-md-3">
								<input type="text" name="articles[title_en]" class="form-control" style="width:100%;" />
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								Pubmed ID
							</div>
							<div class="col-md-3">
								<input type="text" name="articles[title_en]" class="form-control" style="width:100%;" />
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								Subject Area
							</div>
							<div class="col-md-3">
								<select name="articles[documenttype_id]" class="form-control">
									<option value="1001">General</option>
								</select>
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								Journal
							</div>
							<div class="col-md-10">
								<select name="articles[documenttype_id]" class="form-control">
									<option value="1001">Kasetsart Journal (Natural Science)</option>
								</select>
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								Issue Years
							</div>
							<div class="col-md-2">
								<input type="text" name="articles[title_en]" class="form-control" style="width:100%;" />
							</div>
							<div class="col-md-2 head">
								Volume
							</div>
							<div class="col-md-2">
								<input type="text" name="articles[title_en]" class="form-control" style="width:100%;" />
							</div>
							<div class="col-md-2 head">
								Year No.
							</div>
							<div class="col-md-2">
								<input type="text" name="articles[title_en]" class="form-control" style="width:100%;" />
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								Art. No.
							</div>
							<div class="col-md-2">
								<input type="text" name="articles[title_en]" class="form-control" style="width:100%;" />
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-2 head">
								Page Start
							</div>
							<div class="col-md-2">
								<input type="text" name="articles[title_en]" class="form-control" style="width:100%;" />
							</div>
							<div class="col-md-2 head">
								Page End
							</div>
							<div class="col-md-2">
								<input type="text" name="articles[title_en]" class="form-control" style="width:100%;" />
							</div>
							<div class="col-md-2 head">
								Page Count
							</div>
							<div class="col-md-2">
								<input type="text" name="articles[title_en]" class="form-control" style="width:100%;" />
							</div>
						</div>
						<div class="row custom1">
							<div class="col-md-12">
								<button class="">Submit</button>
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
	
	CKEDITOR.inline('abstract-en', {
		language: 'en',
		toolbar:'Full'
	});
	CKEDITOR.inline('abstract-local', {
		language: 'en',
		toolbar:'Full'				
	});
		
</script>