<?php
	use yii\helpers\Url;
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	
	$this->registerCssFile('web-assets/css/home-view.css');
?>

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
										<p class="article-release">1 month ago</p>
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