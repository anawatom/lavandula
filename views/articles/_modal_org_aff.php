<?php
	use yii\bootstrap\ActiveForm;
	use yii\bootstrap\Modal;
?>
<?php $form = ActiveForm::begin([
					'id' => 'formEditOrgAff',
					'layout' => 'horizontal',
					'action' => ['update-org-aff'],
					'method' => 'post'
				]); ?>
	<?php
		Modal::begin([
			'id' => 'editOrgAff',
			'header' => '<h4>Edit Org./Aff</h4>',
			'headerOptions' => [
				'class' => 'modal-title',
			],
			'footer' => '<button type="submit" class="btn btn-primary">'
							.'<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Save'
						.'</button>'
						.'<a class="btn btn-danger" data-dismiss="modal">'
							.'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Close'
						.'</a>'
		]);
	?>
		<input type="hidden" class="" name="authors_input_form_group_index">
		<div class="form-group loading-container">
			<label for="" class="col-md-12">Loading...</label>
		</div>
		<div class="form-group">
			<label for="affiliation-name" class="control-label col-md-2">Aff .</label>
			<div class="form-group col-md-9">
				<input type="hidden" class="" name="affiliation_id">
				<input type="hidden" class="" name="affiliation_lang_id">
				<input type="text" class="form-control" readonly="true" name="affiliation_name">
			</div>
			<a id="editAffButton" class="btn btn-primary col-md-1" data-toggle="tooltip" data-placement="top" title="Edit">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
			</a>
		</div>
		<div class="form-group">
			<label for="organization-name" class="control-label col-md-2">Org .</label>
			<div class="form-group col-md-9">
				<input type="hidden" class="" name="organization_id">
				<input type="text" class="form-control" readonly="true" name="organization_name">
			</div>
			<a id="editOrgButton" class="btn btn-primary col-md-1" data-toggle="tooltip" data-placement="top" title="Edit">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
			</a>
		</div>
		<div class="form-group">
			<pre id="originalData"></pre>
		</div>
	<?php Modal::end(); ?>
<?php ActiveForm::end(); ?>
