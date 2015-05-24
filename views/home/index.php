<?php
	use yii\helpers\Url;
	// Yii::import('application.vendor.*');
	// require_once('Zend/Feed.php');
?>
<!-- --------------------------------------------------------------------------- -->
<div class="container">
	<div class="row header">
		<div class="col-md-12">
			<div class="row topbar">
				<div class="col-md-1">
					<div class="pull-left">
						<a href="#">Home</a>
					</div>
				</div>
				<div class="col-md-11">
					<div class="pull-right">
						<a href="#">Sign up</a> | <a href="#">Launguage</a>
					</div>
				</div>
			</div>
			<div class="row logobar">
				<div class="col-md-4">
					<img src="<?= Url::to('@web/images/aec-logo.png') ?>">
				</div>
				<div class="col-md-8">
					<div class="search-contianer pull-left">
						<div class="row">
							<div class="col-md-12">
								<form>
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search for...">
										<span class="input-group-btn">
											<button class="btn btn-default" type="button">
												<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
											</button>
										</span>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row navbar">
				<div class="col-md-12">
					<nav class="navbar navbar-default">
						<div class="container">
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="nav navbar-nav">
									<li class="active">
										<a href="#">Home</a>
									</li>
									<li>
										<a href="#">About</a>
									</li>
									<li>
										<a href="#">Criteria</a>
									</li>
									<li>
										<a href="#">Jurnal Submission</a>
									</li>
									<li>
										<a href="#">Contact us</a>
									</li>
									<li>
										<a href="#">Download</a>
									</li>
								</ul>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="row content">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default dummy-data">
						<div class="panel-heading">
							<h3 class="panel-title">Categories</h3>
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								<li role="presentation">
									<a href="#">Chemistry</a>
								</li>
								<li role="presentation">
									<a href="#">Energy</a>
								</li>
								<li role="presentation">
									<a href="#">Education & Language</a>
								</li>
								<li role="presentation">
									<a href="#">Economics</a>
								</li>
								<li role="presentation">
									<a href="#">Chermistry</a>
								</li>
								<li role="presentation">
									<a href="#">Meterials</a>
								</li>
								<li role="presentation">
									<a href="#">Physics</a>
								</li>
								<li role="presentation">
									<a href="#">Statistics</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default dummy-data">
						<div class="panel-heading">
							<h3 class="panel-title">Browse <span class="browse-result">9,003,241</span> resources</h3>
						</div>
						<table class="table table-browse-resource">
							<body>
								<tr>
									<td class="resource">Articles</td>
									<td class="value">5,336,028</td>
								</tr>
								<tr>
									<td class="resource">Chapters</td>
									<td class="value">3,162,140</td>
								</tr>
								<tr>
									<td class="resource">Reference Work Entries</td>
									<td class="value">466,468</td>
								</tr>
								<tr>
									<td class="resource">Protocols</td>
									<td class="value">28,605</td>
								</tr>
							</body>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default dummy-data">
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
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default dummy-data">
						<div class="panel-heading">
							<h3 class="panel-title">Recently Articles</h3>
						</div>
						<div class="panel-body">
							<ul class="article-list-container">
								<li class="article-container">
									<div class="row">
										<div class="col-md-10">
											<a class="article-link" href="#">Small Bowel Turnors: Pathology And Management</a>
											<p class="article-description">
												Journal of The Medical Association Of Thailand, 2014
												Williamson, J.M.L, Noel Williamson, R.C.N.
											</p>
										</div>
										<div class="col-md-2">
											<p class="article-release">1 min ago</p>
										</div>
									</div>
								</li>
								<li class="article-container">
									<div class="row">
										<div class="col-md-10">
											<a class="article-link" href="#">The Treatment Outcome Of Redical Radiotherapy In Laryngeal Cencer</a>
											<p class="article-description">
												Journal of The Medical Association Of Thailand, 2014
												Srikawin, J., Pukanhapan, N., Klunklin, P., Sittitrai
											</p>
										</div>
										<div class="col-md-2">
											<p class="article-release">2 min ago</p>
										</div>
									</div>
								</li>
								<li class="article-container">
									<div class="row">
										<div class="col-md-10">
											<a class="article-link" href="#">The Treatment Outcome Of Redical Radiotherapy In Laryngeal Cencer</a>
											<p class="article-description">
												Journal of The Medical Association Of Thailand, 2014
												Srikawin, J., Pukanhapan, N., Klunklin, P., Sittitrai
											</p>
										</div>
										<div class="col-md-2">
											<p class="article-release">2 min ago</p>
										</div>
									</div>
								</li>
								<li class="article-container">
									<div class="row">
										<div class="col-md-10">
											<a class="article-link" href="#">The Treatment Outcome Of Redical Radiotherapy In Laryngeal Cencer</a>
											<p class="article-description">
												Journal of The Medical Association Of Thailand, 2014
												Srikawin, J., Pukanhapan, N., Klunklin, P., Sittitrai
											</p>
										</div>
										<div class="col-md-2">
											<p class="article-release">5 min ago</p>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row footer">
		<div class="col-md-12">
			<div class="coppyright">
				This work is licensed under CC BY-SA<br>
				COPYRIGHT ASEAN CITATION INDEX 2014
			</div>
		</div>
	</div>
</div>