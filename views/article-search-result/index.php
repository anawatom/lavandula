<?php
	use yii\helpers\Html;
	use yii\helpers\Url;	
	
	$this->registerCssFile('web-assets/css/article-search-result-view.css');
?>

<div style="height:10px;"></div>
<?php //print_r($refineByYears); ?>
<div class="row content">
	<div class="col-md-3">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-warning dummy-data refine-by">
					<div class="panel-heading">
						<h3 class="panel-title">Years</h3>
					</div>
					<div class="panel-body">
						<ul class="nav nav-pills nav-stacked countrys">
							<?php foreach($refineByYears as $year_row): ?>
							<li>
								<div>
									<div class="col-md-2"><p class="refine-chk"><input type="checkbox" disabled="disabled" /></p></div>
									<div class="col-md-7"><p class="refine-name"><?=$year_row['year']?></p></div>
									<div class="col-md-3"><p class="refine-cnt">(<?=$year_row['cnt']?>)</p></div>
								</div>
								
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="row">
			<div class="panel panel-warning dummy-data">
				<div class="panel-heading">
					<h3 class="panel-title">Search Result : <?= $keyword ?></h3>
				</div>
				<div class="panel-body">
					<ul class="nav nav-pills nav-stacked search-results">
						<?php if (!empty($data)) : ?>
						
						<?php $results_count=1; ?>
						<?php foreach($data as $key=>$row):?>
						<li>
							<div class="row">
								<div class="col-md-1"><p class="result-no"><?=$results_count++?></p></div>
								<div class="col-md-10">
									<a href="<?=Url::to(['/articles/public-view', 'id'=>$row['id']]);?>" target="_blank"><p class="title"><?=$row['title']?></p></a>
									<p class="authors"> By 
									<?php 
										$authors = json_decode($row['authors']);
										$author_count = count($authors);
										$print_comma = false;
										for($i=0; $i<$author_count; $i++){
											foreach($authors[$i] as $author_id=>$author_row){
												if($print_comma){ echo ', '; }else{ $print_comma=true; }
												echo "<a href=\"#\">{$author_row->name}</a>";
											}
										}
									?>
									</p>
									<a href="#"><p class="journal"><?=$row['journal']?></p></a>
								</div>
								<div class="col-md-1"><p class="cited">Cited<br /><?=(empty($row['cited'])?'0':$row['cited'])?></p></div>
							</div>
						</li>
						<?php endforeach;?>
						
						<?php else: ?>
							<div class="col-md-1"></div>
							<div class="col-md-11">0 Found.</div>
						<?php endif;?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
