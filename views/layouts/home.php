<?php
	use yii\helpers\Html;
	use yii\bootstrap\Nav;
	use yii\bootstrap\NavBar;
	use yii\widgets\Breadcrumbs;
	use yii\helpers\Url;
	use yii\db\Expression;
	use app\assets\AppAsset;
	use app\models\CttPageContents;
	use himiklab\jqgrid\JqGridWidget;
	use yii\web\Authentication;
	use kartik\growl\Growl;
	use yii\bootstrap\ActiveForm;
	use yii\web\Session;

	AppAsset::register($this);
	define('DOC_WIDTH', 1316);
	
	$session = new Session;
	$session->open();

	$language = Yii::$app->session->get('app.language');
	if (!$language) {
		$language = Yii::$app->language;
	}

	$currentUser = \Yii::$app->user->getIdentity();
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<head>
		<meta charset="<?= Yii::$app->charset ?>"/>
		<link rel="shortcut icon" type="image/ico" href="<?php //echo Url::to('@web/images/favicon.ico'); ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
		<title>ACI</title>
		<?php $this->head() ?>
	</head>
	<body>
		<?php $this->beginBody(); ?>
		<?php //echo print_r(Yii::$app->params['staticdata']['countrys']); ?>
		<div class="container main-container">
			<?php
				//Get all flash messages and loop through them
				foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
					echo Growl::widget([
						'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
						'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
						'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
						'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
						'showSeparator' => $message['showSeparator'],
						'delay' => (!empty($message['delay'])) ? $message['delay'] : 300,
						'pluginOptions' => [
							'showProgressbar' => true,
							'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
							'placement' => [
								'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
								'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
							]
						]
					]);
					Yii::$app->session->removeFlash($key);
				}

				//$nosuuportbrowser = '<div style="-webkit-border-radius: 5px;border-radius: 5px;  margin: 0 15px;border: 1px solid red;background-color: linen;padding: 20px;">Browser version นี้ไม่สามารถใช้งานได้ กรุณาใช้ Browser ที่รองรับ HTML5 หรือดาวน์โหลดได้ที่นี่ <a href="https://www.google.com/chrome/browser/desktop/index.html?system=true&standalone=1">คลิก</a></div>';
			?>
			<!-- Header -->
			<div class="row header-container">
				<div class="col-sm-2 col-md-2">
					<!-- Language bar -->
					<!-- <div class="language-contianer">
						<a href="<?= Url::to(['home/set-language', 'current_url' => Url::current(), 'lang' => 'en_US']); ?>" class="<?= ($language=='en_US')? 'active':''; ?>">Eng</a> | 
						<a href="<?= Url::to(['home/set-language', 'current_url' => Url::current(), 'lang' => 'th']); ?>" class="<?= ($language=='th')? 'active':''; ?>">TH</a>
					</div> -->
					<!-- End Language bar -->
					
					<!-- Logo -->
					<div class="logo-contianer">
						<div class="logo" style="text-align: center;">
							<img src="<?= Url::to('@web/images/aec-logo-v2.png') ?>">
						</div>
					</div>
					<!-- End logo -->
				</div>
				<div class="col-sm-10 col-md-10">
					<div class="member-contianer">
						<?php if (empty($currentUser)) : ?>
							<?= Html::a('Login', ['site/login']); ?> <br />
						<?php else :?>
							<span style="font-weight:bold;"><?= $currentUser->username; ?></span> : 
							<a href="<?= Url::to(['site/logout'])?>" data-method="post">Logout</a>
						<?php endif ?>
					</div>
					<!-- Basic search -->
					<div class="search-contianer">
						<div class="row">
							<div class="col-md-12">
								<div style="padding:0 0 2px 5px;font-size:16px;color:darkblue;">Searchable <?=number_format(28633/*$article_count*/)?> items</div>
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
												<input type="hidden" name="type" value="basic" />
									<div class="input-group">
										<?= Html::input('text', 'keyword', empty($keyword)?'':$keyword, ['class'=>'form-control',
																		'placeholder' => Yii::t('app/frontend', 'Search...'),
																		'style' => 'height:40px;font-size:18px;']) ?>
										<span class="input-group-btn">
											<?= Html::submitButton('<span class="glyphicon glyphicon-search" aria-hidden="true"></span>', 
																	['class' => 'btn btn-primary',
																	'style' => 'height:40px;']) ?>
											<?= Html::Button('<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>', 
																	['class' => 'btn btn-warning advance-search',
																			'onclick' => 'window.location=\''.Url::to(['/article-search-result/advance-search']).'\'',
																	'style' => 'height:40px;']) ?>
										</span>
									</div>
								<?php ActiveForm::end(); ?>
								
							</div>
						</div>
					</div>
					<!-- End Basic search -->
				</div>
			</div>
			<!-- End Header -->
			<!-- Navbar -->
			<div class="row">
				<div class="col-sm-12 col-md-12 navbar-container">
					<nav class="navbar navbar-default nav-top navbar-contianer">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="navbar-collapse" style="padding: 0;overflow: hidden;">
							<ul class="nav navbar-nav nav-tabs nav-justified">
								<li class="bg-green">
									<a class="nav-link" href="?r=home"><?= Yii::t('app/frontend', 'HOME'); ?> <span class="sr-only">(current)</span></a>
								</li>
								<?php 
									function get_href($menu){
										if(empty($menu['menu_type']) || $menu['menu_type']=='content'){
											$href=Url::to(['/contents/index', 'id'=>$menu['id']]);
										}else if($menu['menu_type']=='url'){
											$href=$menu['contents'];
										}
										return $href;
									}
									function generate_menu($id){
										
										$is_content = new Expression("CASE WHEN menu_type='url' THEN contents ELSE 0 END AS contents");
										
										$pageContents_Main = CttPageContents::find()->select(['id','menu_id', 'elm_class', 'menu_type', 'name', $is_content])->where(['id' => $id, 'lang_id' => 1])->all();
										$pageContents_Sub = CttPageContents::find()->select(['id','menu_id', 'elm_class', 'menu_type', 'name', $is_content])->where(['menu_id' => $id, 'lang_id' => 1])->all();
										//echo '<pre>';print_r($pageContents_Main);echo '</pre>';
										
										$menu_sub = '';
										if(count($pageContents_Sub)>0){
											$menu_sub = "<ul class=\"dropdown-menu\" role=\"menu\">";
											$href = '';
											foreach($pageContents_Sub as $sub_menu){
												$href = get_href($sub_menu);
												$menu_sub .= "<li><a href=\"{$href}\">{$sub_menu['name']}</a></li>";
											}
											if (\Yii::$app->user->can('createData') ){
												$menu_sub .= "<li><a href=\"#\">* Add New Page *</a></li>";
											}
											$menu_sub .= "</ul>";
										}
										
										echo "<li class=\"{$pageContents_Main[0]['elm_class']}\">";
										if(count($pageContents_Sub)>0){
											echo "<a class=\"nav-link dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\" href=\"#\">".Yii::t('app/frontend', $pageContents_Main[0]['name'])."<span class=\"caret\"></span></a>";
										}else{
											echo "<a class=\"nav-link\" href=\"".get_href($pageContents_Main[0])."\">".Yii::t('app/frontend', $pageContents_Main[0]['name'])."</a>";
										}
										echo $menu_sub;
										echo "</li>";
									}
								?>
								
								<?=generate_menu(1)?> <!-- ABOUT -->
								
								<?=generate_menu(2)?> <!-- CRITERIA -->
								
								<?=generate_menu(3)?> <!-- JOURNAL SUBMISSION -->
								
								<?=generate_menu(4)?> <!-- CONTACT -->
								
								<?=generate_menu(5)?> <!-- DOWNLOAD -->
								
								<?php if (\Yii::$app->user->can('superAdministrator')) { ?>
									<li class="bg-yellow">
										<a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" href="#">
											<?= Yii::t('app/frontend', 'Admin'); ?>
											<span class="caret"></span>
										</a>
										<ul class="dropdown-menu" role="menu">
											<li class="divider"></li>
											<li><a href="?r=articles/metadata-extractor">PDF Metadata Extractor</a></li>
											<li><a href="?r=articles/importer">Article Importer</a></li>
											<li><a href="#">Article Approval</a></li>
											<li class="divider"></li>
											<li><a href="?r=user">User Management</a></li>
											<li><a href="?r=articles">Article Management</a></li>
											<li><a href="#">Issue Management</a></li>
											<li><a href="#">Author Management</a></li>
											<li><a href="#">Journal Management</a></li>
											<li><a href="#">Publisher Management</a></li>
											<li class="divider"></li>
											<li><a href="?r=staticdata-countrys">Country Management</a></li>
											<li><a href="?r=staticdata-languages">Language Management</a></li>
											<li><a href="?r=staticdata-subjectarea">Subject Area Management</a></li>
											<li><a href="?r=staticdata-affiliation">Affiliation Management</a></li>
											<li><a href="?r=staticdata-documenttype">Document Type Management</a></li>
											<li><a href="?r=staticdata-documentsource">Document Source Management</a></li>
											<li><a href="?r=staticdata-sourcetype">Source Type Management</a></li>
											<li class="divider"></li>
										</ul>
									</li>
								<?php } ?>
							</ul>
						</div>
					</nav>
				</div>
			</div>
			<!-- End Navbar -->
			<!-- Breadcrumbs -->
			<div class="row">
				<?=
					Breadcrumbs::widget([
						'homeLink' => [
							'label' => Yii::t('app/frontend', 'HOME'),
							'url' => Yii::$app->homeUrl,
							],
						'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
					])
				?>
			</div><!-- End Breadcrumbs -->
			<!-- Content -->
			<div class="row">
				<div class="col-sm-12 col-md-12 content-container">
					<?php echo $content; ?>
				</div>
			</div>
			<!-- End Content -->
			<!-- Footer -->
			<div class="row">
				<div class="col-sm-12 col-md-12 footer-contianer">
					<div class="coppyright-contianer">
						© COPYRIGHT ASEAN CITATION INDEX 2014
					</div>
					<div class="address-contianer">
						ACI Secretariat: c/o 5th Floor, School of Energy Environment and Materials, King Mongkut’s University of Technology Thonburi<br />
						126 Prachautid Road, Bangmod, Thung Khru, Bangkok 10140, Thailand<br />
						Tel. and Fax +66 2470 8647 Email: aci.cites@gmail.com
					</div>
				</div>
			</div>
			<!-- End Footer -->
		</div>
		<script type="text/javascript">
		</script>
		<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>