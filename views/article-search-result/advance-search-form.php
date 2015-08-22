<?php
	use yii\helpers\Html;
	use yii\helpers\Url;	
	
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

<div class="row content">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-warning dummy-data">
					<div class="panel-heading">
						<h3 class="panel-title">Advance Search</h3>
					</div>
					<div class="panel-body advance-search-form">
						<?php $form = yii\bootstrap\ActiveForm::begin([
												'action' => ['/article-search-result/index'],
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
							<div class="row custom1">
								<div class="col-md-8">
								</div>
								<div class="col-md-4">
									<button type="button" class="btn btn-success add" onclick="add_criteria_input()">Add Criteria</button>
									<button type="submit" class="btn btn-primary search">Search</button>
								</div>
							</div>
							<div id="criteria-form2">
								<div class="row custom1">
									
									<div class="col-md-1">
									
									</div>
									<div class="col-md-1">
										<input type="hidden" name="type" value="advance" />
										<input type="hidden" name="cause[]" value="" />
										<input type="hidden" name="operand[]" value="like" />
									</div>
									<div class="col-md-3">
										<input type="text" name="keyword[]" class="form-control" placeholder="Keyword" />
									</div>
									<div class="col-md-3">
										<select class="form-control" name="field[]">
											<option value="topic">Topic</option>
											<option value="author">Author</option>
											<option value="journal">Journal</option>
											<option value="affiliation">Affiliation</option>
											<option value="publisher">Publisher</option>
											<option value="doi">Doi</option>
											<option value="year">Year</option>
											<option value="citedauthor">Cited Author</option>
										</select>
									</div>
									<div class="col-md-3">
									</div>
									<div class="col-md-1">
									</div>
								</div>
							</div>
							<div class="row custom1">
								<div class="col-md-1">
								</div>
								<div class="col-md-2 head">
									Document Type
								</div>
								<div class="col-md-2">
									<select class="form-control" name="doctype">
										<option value="0">All</option>
										<option value="1">Article</option>
										<option value="2">Letter</option>
										<option value="3">Review</option>
									</select>
								</div>
							</div>
							<div class="row custom1">
								<div class="col-md-2">
								</div>
								<div class="col-md-1 head">
									Years
								</div>
								<div class="col-md-2">
									<input type="text" class="form-control" name="year_start" />
								</div>
								<div class="col-md-1 head">
									To
								</div>
								<div class="col-md-2">
									
									<input type="text" class="form-control" name="year_end" value="2015" />
								</div>
							</div>
							<div class="row custom1">
								<div class="col-md-1">
								</div>
								<div class="col-md-2 head">
									Subject Area
								</div>
								<div class="col-md-2">
									<input id="chksubjectarea-6" type="checkbox" name="subject_area[]" value="0" />
									<label for="chksubjectarea-6">Select All</label>
								</div>
								<div class="col-md-2">
									<input id="chksubjectarea-1" type="checkbox" name="subject_area[]" value="1" />
									<label for="chksubjectarea-1">General</label>
								</div>
								<div class="col-md-2">
									<input id="chksubjectarea-2" type="checkbox" name="subject_area[]" value="2" />
									<label for="chksubjectarea-2">Physical Sciences</label>
								</div>
							</div>
							<div class="row custom1">
								<div class="col-md-1">
								</div>
								<div class="col-md-2 head">
								</div>
								<div class="col-md-2">
									<input id="chksubjectarea-3" type="checkbox" name="subject_area[]" value="3" />
									<label for="chksubjectarea-3">Health Sciences</label>
								</div>
								<div class="col-md-2">
									<input id="chksubjectarea-4" type="checkbox" name="subject_area[]" value="4" />
									<label for="chksubjectarea-4">Social Sciences</label>
								</div>
								<div class="col-md-2">
									<input id="chksubjectarea-5" type="checkbox" name="subject_area[]" value="5" />
									<label for="chksubjectarea-5">Life Sciences</label>
								</div>
								<div class="col-md-2">
								</div>
							</div>
						<div style="padding-bottom:50px;"></div>
							
						<?php yii\bootstrap\ActiveForm::end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	function add_criteria_input(){
		jQuery('#criteria-form2').append('<div class="row custom1">\
				<div class="col-md-1">\
				</div>\
				<div class="col-md-1">\
					<select class="form-control" name="cause[]">\
						<option value="AND">AND</option>\
						<option value="OR">OR</option>\
						<option value="NOT">NOT</option>\
					</select>\
					<input type="hidden" name="operand[]" value="like" />\
				</div>\
				<div class="col-md-3">\
					<input type="text" name="keyword[]" class="form-control" placeholder="Keyword" />\
				</div>\
				<div class="col-md-3">\
					<select class="form-control" name="field[]">\
						<option value="topic">Topic</option>\
						<option value="author">Author</option>\
						<option value="jornal">Journal</option>\
						<option value="affiliation">Affiliation</option>\
						<option value="publisher">Publisher</option>\
						<option value="doi">Doi</option>\
						<option value="year">Year</option>\
						<option value="citedauthor">Cited Author</option>\
					</select>\
				</div>\
				<div class="col-md-2">\
					<button type="button" class="btn btn-success btn-xs remove" onclick="remove_criteria_input(this)">-</button>\
				</div>\
				<div class="col-md-1">\
				</div>\
			</div>');
	}
	function remove_criteria_input(t){
		jQuery(t).parent().parent().remove();
	}
</script>