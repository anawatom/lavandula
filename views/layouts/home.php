<?php
	use yii\helpers\Html;
	use yii\bootstrap\Nav;
	use yii\bootstrap\NavBar;
	use yii\widgets\Breadcrumbs;
	use yii\helpers\Url;
	use app\assets\AppAsset;
	use app\models\WA_GROUP_USER;
	use himiklab\jqgrid\JqGridWidget;
	use yii\web\Authentication;
	use kartik\growl\Growl;

	AppAsset::register($this);
	define('DOC_WIDTH', 1316);

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
		<link rel="shortcut icon" type="image/ico" href="<?php echo Url::to('@web/images/favicon.ico'); ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
		<title>ACI</title>
		<?php $this->head() ?>
	</head>
	<body>
		<?php $this->beginBody(); ?>
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
			<div class="row">
				<div class="col-sm-12 col-md-12 header-container">
					<!-- Language bar -->
					<div class="language-contianer">
						<a href="<?= Url::to(['home/set-language', 'lang' => 'en-US']); ?>" class="<?= ($language=='en-US')? 'active':''; ?>">Eng</a> | 
						<a href="<?= Url::to(['home/set-language', 'lang' => 'th']); ?>" class="<?= ($language=='th')? 'active':''; ?>">TH</a>
					</div><!-- End Language bar -->
					<!-- Logo -->
					<div class="logo-contianer">
						<div class="logo">
							<img src="<?= Url::to('@web/images/aec-logo.png') ?>">
						</div>
						<div class="member-contianer">
							<b>Member:</b> Login <span class="glyphicon glyphicon-triangle-bottom" ></span><br />
							<span><?php echo $currentUser->username.' ('.$currentUser->role->name.') '; ?></span><br />
							<a href="<?= Url::to(['site/logout'])?>" data-method="post">Logout</a>
						</div>
					</div>
					<!-- End logo -->
					<!-- Navbar -->
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
									<a class="nav-link" href="#"><?= Yii::t('app/frontend', 'HOME'); ?> <span class="sr-only">(current)</span></a>
								</li>
								<li class="bg-yellow">
									<a class="nav-link" href="#"><?= Yii::t('app/frontend', 'ABOUT'); ?></a>
								</li>
								<li class="bg-red">
									<a class="nav-link" href="#"><?= Yii::t('app/frontend', 'CRITERIA'); ?></a>
								</li>
								<li class="bg-sky">
									<a class="nav-link" href="#"><?= Yii::t('app/frontend', 'JOURNAL SUBMISSION'); ?></a>
								</li>
								<li class="bg-purple">
									<a class="nav-link" href="#"><?= Yii::t('app/frontend', 'CONTACT'); ?></a>
								</li>
								<li class="bg-sky">
									<a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" href="#">
										<?= Yii::t('app/frontend', 'Admin'); ?>
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu" role="menu">
										<li class="divider"></li>
										<li><a href="?r=ctt-articles">Article Management</a></li>
										<li><a href="#">Author Management</a></li>
										<li><a href="#">Journal Management</a></li>
										<li><a href="#">Publisher Management</a></li>
										<li class="divider">Static Data</li>
										<li><a href="#">Country Management</a></li>
										<li><a href="?r=ctt-staticdata-languages">Language Management</a></li>
										<li><a href="#">Subject Area Management</a></li>
										<li><a href="#">Affiliation Management</a></li>
										<li><a href="#">Document Type Management</a></li>
										<li><a href="#">Issue Management</a></li>
										<li class="divider"></li>
									</ul>
								</li>
							</ul>
						</div>
					</nav>
					<!-- End Navbar -->
					<!-- Slider -->
					<div class="slider-contianer">
						<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: <?=DOC_WIDTH?>px; height: 400px; overflow: hidden; ">
							<!-- Loading Screen -->
							<div u="loading" style="position: absolute; top: 0px; left: 0px;">
								<div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
									background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
								</div>
								<div style="position: absolute; display: block; background: url(<?= Url::to('@web/images/loading.gif') ?>) no-repeat center center;
									top: 0px; left: 0px;width: 100%;height:100%;">
								</div>
							</div>
							<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: <?=DOC_WIDTH?>px; height: 400px; overflow: hidden;">
								<div>
									<img u="image" src="<?= Url::to('@web/images/lanscape/slide1.jpg') ?>" />
								</div>
								<div>
									<img u="image" src="<?= Url::to('@web/images/lanscape/slide2.jpg') ?>" />
								</div>
							</div>
						</div>
					</div>
					<!-- End Slider -->
				</div>
			</div>
			<!-- End Header -->
			<?php if (\Yii::$app->user->can('updateData')) { ?>
			<?php } ?>
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
			jQuery(document).ready(function ($) {

				var _SlideshowTransitions = [
												//Fade
												{ $Duration: 1200, $Opacity: 2 }
											];

				var options = {
					$AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
					$AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
					$AutoPlayInterval: 5000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
					$PauseOnHover: 0,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

					$ArrowKeyNavigation: false,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
					$SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
					//         $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
					//$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
					//$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
					$SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
					$DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
					$ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
					$UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
					$PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
					$DragOrientation: 0,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

					$SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
					$Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
					$Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
					$TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
					$ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
					},

					$BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
					$Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
					$ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
					$AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
					$Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
					$Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
					$SpacingX: 10,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
					$SpacingY: 10,                                   //[Optional] Vertical space between each item in pixel, default value is 0
					$Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
					},

					$ArrowNavigatorOptions: {
					$Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
					$ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
					$Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
					}
				};
				var jssor_slider1 = new $JssorSlider$("slider1_container", options);

				//responsive code begin
				//you can remove responsive code if you don't want the slider scales while window resizes
				function ScaleSlider() {
					var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
					if (parentWidth)
						jssor_slider1.$ScaleWidth(Math.min(parentWidth, <?=DOC_WIDTH?>));
					else
						window.setTimeout(ScaleSlider, 30);
				}
				ScaleSlider();

				$(window).bind("load", ScaleSlider);
				$(window).bind("resize", ScaleSlider);
				$(window).bind("orientationchange", ScaleSlider);
				//responsive code end

				jQuery('div.nav-top li').mouseenter(function(){
					jQuery(this).animate({
					height: "75px",
					// cursor: "pointer"
					}, 100, function() {
					// Animation complete.
					});
				});

				jQuery('div.nav-top li').mouseleave(function(){
					jQuery(this).animate({
					height: "65px"
					}, 100, function() {
					// Animation complete.
					});
				});
			});
		</script>
		<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>