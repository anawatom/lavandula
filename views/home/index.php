<?php
	use yii\helpers\Url;
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	
	$this->registerCssFile('web-assets/css/home-view.css');
?>
<!-- Search -->
<div class="row">
	<div class="col-md-12">
		<div class="search-container">
			<div id="frmsearchbox">
				<div style="padding:0 0 2px 5px;font-size:16px;color:darkblue;">Searchable <?=number_format($article_count)?> items</div>
				<div class="search-contianer pull-left">
					<div class="row">
						<div class="col-md-12">
							<?php $form = ActiveForm::begin([
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
								<div class="input-group">
									<?= Html::input('text', 'keyword', '', ['class'=>'form-control',
																	'placeholder' => Yii::t('app/frontend', 'Search...'),
																	'style' => 'height:50px;font-size:18px;']) ?>
									<span class="input-group-btn">
										<?= Html::submitButton('<span class="glyphicon glyphicon-search" aria-hidden="true"></span>', 
																['class' => 'btn btn-primary',
																'style' => 'height:50px;']) ?>
									</span>
								</div>
							<?php ActiveForm::end(); ?>
							
							<!-- <form action="<?=Url::to(['/article-search-result/search']);?>" method="post">
								<div class="input-group">
									<input type="text" class="form-control" name="keywords" style="height:50px;font-size:18px;" placeholder="<?= Yii::t('app/frontend', 'Search...'); ?>">
									<span class="input-group-btn">
										<button class="btn btn-success" style="height:50px;" type="submit">
											<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
										</button>
									</span>
								</div>
							</form> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Search -->
<!-- Body -->
<div class="row content">
	<div class="col-md-3">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-warning dummy-data">
					<div class="panel-heading">
						<h3 class="panel-title">Countrys</h3>
					</div>
					<div class="panel-body">
						<ul class="nav nav-pills nav-stacked countrys">
							<li role="presentation">
								<a href="#"><img src="images/country-icon/brunei-darussalam.png" />Brunei Darussalam</a>
							</li>
							<li role="presentation">
								<a href="#"><img src="images/country-icon/cambodia.png" />Cambodia</a>
							</li>
							<li role="presentation">
								<a href="#"><img src="images/country-icon/indonesia.png" />Indonesia</a>
							</li>
							<li role="presentation">
								<a href="#"><img src="images/country-icon/lao-pdr.png" />Lao PDR</a>
							</li>
							<li role="presentation">
								<a href="#"><img src="images/country-icon/malaysia.png" />Malaysia</a>
							</li>
							<li role="presentation">
								<a href="#"><img src="images/country-icon/myanmar.png" />Myanmar</a>
							</li>
							<li role="presentation">
								<a href="#"><img src="images/country-icon/philippines.png" />Philippines</a>
							</li>
							<li role="presentation">
								<a href="#"><img src="images/country-icon/singapore.png" />Singapore</a>
							</li>
							<li role="presentation">
								<a href="#"><img src="images/country-icon/thailand.png" />Thailand</a>
							</li>
							<li role="presentation">
								<a href="#"><img src="images/country-icon/vietnam.png" />Vietnam</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-warning dummy-data">
					<div class="panel-heading">
						<h3 class="panel-title">Recently Articles</h3>
					</div>
					<div class="panel-body">
						<ul class="article-list-container recently-article">
							<?php foreach($recently_articles as $article): ?>
							<li class="article-container">
								<div class="row">
									<div class="col-md-9">
										<a class="article-link" href="<?=Url::to(['/articles/public-view', 'id'=>$article['id']]);?>"><p class="title"><?=$article['title']?></p></a>
										<p class="authors">
										<?php 
											$authors = json_decode($article['authors']);
											$author_count = count($authors);
											$print_comma = false;
											for($i=0; $i<$author_count; $i++){
												foreach($authors[$i] as $author_id=>$row){
													if($print_comma){ echo ', '; }else{ $print_comma=true; }
													echo "<a href=\"#\">{$row->name}</a>";
												}
											}
										?>
										</p>
										
									</div>
									<div class="col-md-3">
										<p class="article-release">20 days ago</p>
									</div>
								</div>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-warning dummy-data">
					<div class="panel-heading">
						<h3 class="panel-title">Announcement and Events</h3>
					</div>
					<div class="panel-body">
						<ul class="nav nav-pills nav-stacked">
							<li role="presentation">
								<a href="#">ASIA: ASEAN May Create Research Citation Index(05 December 2010)</a>
							</li>
							<li role="presentation">
								<a href="#">The 3nd ACT Steering Committee Meeting</a>
							</li>
							<li role="presentation">
								<a href="#">The 2nd ACT Steering Committee Meeting</a>
							</li>
							<li role="presentation">
								<a href="#">The 1nd ACT Steering Committee Meeting</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>