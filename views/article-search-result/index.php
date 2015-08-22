<?php
	use yii\helpers\Html;
	use yii\helpers\Url;	
	
	$this->registerCssFile('web-assets/css/article-search-result-view.css');
?>

<div class="row content">
	<div class="col-md-3">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-warning dummy-data refine-by">
					<div class="panel-heading">
						<h3 class="panel-title">Refine by Years</h3>
					</div>
					<div class="panel-body refine-by refine-by-years">
						<div style="text-align:center;"><img src="<?= Url::to('@web/images/loading.gif') ?>"></div>
						<!--table style="width:100%;">
						< ?php foreach($refineByYears as $year_row): ?>
							<tr>
								<td class="refine-name"><input type="checkbox" onclick="setRefineBy('year', '< ?=$year_row['year']?>')" /> < ?=$year_row['year']?></td>
								<td class="refine-cnt">(< ?=$year_row['cnt']?>)</td>
							</tr>
						< ?php endforeach; ?>
						</table-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-warning dummy-data">
					<div class="panel-heading">
						<h3 class="panel-title">Search Result : <?= $keyword ?> <span id="searchresult-count"></span></h3>
					</div>
					<div class="panel-body search-result-contents">
						<div style="text-align:center;"><img src="<?= Url::to('@web/images/loading.gif') ?>"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var search_type = '<?=$type?>';
function search(type, url){
	if(url==undefined){
		url = "<?= Url::to(['article-search-result/get-search-result']) ?>";
	}
	var data = {type: type, _csrf: '<?=Yii::$app->request->getCsrfToken()?>'};
	jQuery.post( url, data, function( data ) {
		jQuery( ".panel-body.search-result-contents" ).html( data );

		jQuery.each(jQuery( ".panel-body.search-result-contents" ).find('.pagination li a'), function(){
			
			jQuery(this).attr('url', jQuery(this).attr('href'));
			jQuery(this).attr('href', '#');
			jQuery(this).click(function(){
				jQuery( ".panel-body.search-result-contents" ).html( '<div style="text-align:center;"><img src="<?= Url::to('@web/images/loading.gif') ?>"></div>' );
				search(search_type, jQuery(this).attr('url'));
			});
		});
	});
}
function renderRefineByYears(keyword){
	var data = {keyword: keyword, _csrf: '<?=Yii::$app->request->getCsrfToken()?>'};
	jQuery.post( "<?= Url::to(['article-search-result/get-refine-by-years']) ?>", data, function( data ) {
		jQuery( ".panel-body.refine-by-years" ).html( data );
	});
}
function onclick_RefineBy(field, value){
	jQuery( ".panel-body.search-result-contents" ).html( '<div style="text-align:center;"><img src="<?= Url::to('@web/images/loading.gif') ?>"></div>' );
	//TODO: Add field to session
	var data = {field:field, value:value};
	jQuery.post( "<?= Url::to(['article-search-result/add-refine']) ?>", data, function( data ) {
		search(search_type);
	});
}

search(search_type);
renderRefineByYears('<?=$keyword?>');
</script>