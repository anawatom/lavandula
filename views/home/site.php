<?php
	use yii\helpers\Url;
	
	define('DOC_WIDTH', 1316);
?>

<style type="text/css">
body{
	background-color: #F5F5F5;
}
div.page{
	width:<?=DOC_WIDTH?>px;
	margin: 0 auto;
	padding: 0;
	border-top: solid #F5F5F5 7px;
}
div.page div.header{
	color: white;
	padding: 20px 20px;
	height: 150px;
	width: 100%;
	background: -moz-linear-gradient(top,  rgba(104,173,0,1) 0%, rgba(115,178,10,1) 40%, rgba(126,183,20,0.79) 79%, rgba(150,186,87,0.73) 90%, rgba(172,188,147,0.5) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(104,173,0,1)), color-stop(40%,rgba(115,178,10,1)), color-stop(79%,rgba(126,183,20,0.79)), color-stop(90%,rgba(150,186,87,0.73)), color-stop(100%,rgba(172,188,147,0.5))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  rgba(104,173,0,1) 0%,rgba(115,178,10,1) 40%,rgba(126,183,20,0.79) 79%,rgba(150,186,87,0.73) 90%,rgba(172,188,147,0.5) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  rgba(104,173,0,1) 0%,rgba(115,178,10,1) 40%,rgba(126,183,20,0.79) 79%,rgba(150,186,87,0.73) 90%,rgba(172,188,147,0.5) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  rgba(104,173,0,1) 0%,rgba(115,178,10,1) 40%,rgba(126,183,20,0.79) 79%,rgba(150,186,87,0.73) 90%,rgba(172,188,147,0.5) 100%); /* IE10+ */
	background: linear-gradient(to bottom,  rgba(104,173,0,1) 0%,rgba(115,178,10,1) 40%,rgba(126,183,20,0.79) 79%,rgba(150,186,87,0.73) 90%,rgba(172,188,147,0.5) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#68ad00', endColorstr='#80acbc93',GradientType=0 ); /* IE6-9 */
		
}
div.nav-top ul{
    list-style-type: none;
    margin: 0;
    padding: 0;
}
div.nav-top li{
	float:left;
    width: 224px;
    height: 65px;
    text-align:center;
    padding-top: 20px;
    opacity: .8;
 	cursor: pointer;
}
div.nav-top li:hover{
	opacity: 1;
}
div.nav-top li a{
	font-weight: 500 !important; 
/* 	font: normal 14px/18px Open Sans; */
	font-size: 16px;
	color: white;
	
}
.bg-green{
	background-color: #4caf30;
}
.bg-yellow{
	background-color: #ffca00;
}
/* .bg-orange{ */
/* 	background-color: #fd5308; */
/* } */
.bg-red{
	background-color: #e90000;
}
.bg-purple{
	background-color: #6000b8;
}
.bg-sky{
	background-color: #0093c5;
}

div.search-box{
	padding: 40px 0;
	background-color: white;
	height: 170px;
	border-top: solid #3b3f46 4px;
	border-bottom: solid #3b3f46 4px;
}
#frmsearchbox{
	margin: 0 auto;
	width: 60%;
}
div.recenly-article{
/* 	height: 500px; */
	background-color: #FBFBFB;
	padding: 20px 5px 0 5px;
}
div.country-list ul{
	list-style-type: none;
    margin: 0;
    padding: 0;
}

div.country-list li{
	width: 200px;
    height: 30px;
    text-align:left;
    padding: 5px 0 0 10px;
/*     padding: 2.5px 5px 5px 5px; */
/*     padding-top: 20px; */
/*     opacity: .8; */
 	cursor: pointer;
 	background-color:white;
}
div.country-list li:hover, div.country-list a:hover{
	background-color:#50535a;
}
div.country-list img{
	margin-right: 4px;
	margin-top: -4px;
}
</style>


<div class="country-list" style="display:none;position:absolute;top:50px;right:80px;z-index:6;">
	<ul>
		<li><a href="#"><img src="<?=Url::to('@web/images/country-icon/brunei-darussalam.png')?>" />BRUNIE DARUSSALAM</a></li>
		<li><a href="#"><img src="<?=Url::to('@web/images/country-icon/cambodia.png')?>" />CAMBODIA</a></li>
		<li><a href="#"><img src="<?=Url::to('@web/images/country-icon/indonesia.png')?>" />INDONESIA</a></li>
		<li><a href="#"><img src="<?=Url::to('@web/images/country-icon/lao-pdr.png')?>" />LAO PDR</a></li>
		<li><a href="#"><img src="<?=Url::to('@web/images/country-icon/malaysia.png')?>" />MALAYSIA</a></li>
		<li><a href="#"><img src="<?=Url::to('@web/images/country-icon/myanmar.png')?>" />MYANMAR</a></li>
		<li><a href="#"><img src="<?=Url::to('@web/images/country-icon/philippines.png')?>" />PHILIPPINES</a></li>
		<li><a href="#"><img src="<?=Url::to('@web/images/country-icon/singapore.png')?>" />SINGAPORE</a></li>
		<li><a href="#"><img src="<?=Url::to('@web/images/country-icon/thailand.png')?>" />THAILAND</a></li>
		<li><a href="#"><img src="<?=Url::to('@web/images/country-icon/vietnam.png')?>" />VIETNAM</a></li>
	</ul>
</div>

<div class="page">

	<div class="header">
		<div style="float: left; width:320px; overflow:hidden; background-color:lightgray;"><img src="<?= Url::to('@web/images/aec-logo.png') ?>"></div>
		<div class="country-button" style="float:right; cursor:pointer;" ><b>Select Country :</b> Thailand <span class="glyphicon glyphicon-triangle-bottom" ></span></div>
	</div>
	
	<div class="img-slider" style="clear: both;position:relative;">
		<div class="nav-top" style="position:absolute;z-index:5;left:100px;">
			<ul>
				<li class="bg-green"><a href="#">HOME</a></li>
				<li class="bg-yellow"><a href="#">ABOUT</a></li>
				<li class="bg-red"><a href="#">CRITERIA</a></li>
				<li class="bg-sky"><a href="#">JOURNAL SUBMISSION</a></li>
				<li class="bg-purple"><a href="#">CONTACT</a></li>
			</ul>
		</div>
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
	
	<div class="search-box" style="clear: both;position:relative;">
		<form action="<?=Url::to('search');?>" method="post">
			<div id="frmsearchbox">
				<div style="padding:0 0 2px 5px;font-size:16px;color:darkblue;">Searchable 9,003,241 items</div>
				<div class="search-contianer pull-left">
					<div class="row">
						<div class="col-md-12">
							<form>
								<div class="input-group">
									<input type="text" class="form-control" style="height:50px;font-size:18px;" placeholder="Search for...">
									<span class="input-group-btn">
										<button class="btn btn-default" style="height:50px;" type="button">
											<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
										</button>
									</span>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	
	<div class="recenly-article" style="clear: both;position:relative;">
		<div class="row content">
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-warning dummy-data">
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
						<div class="panel panel-warning dummy-data">
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
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-warning dummy-data">
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
	</div>
	
	<div class="footer" style="clear: both;position:relative;height:120px;background-color:#31353d;margin-top:20px;color:#79808f;">
		<div style="text-align:center;"><span style="color:#8dbf41; font-size: 18px;">© COPYRIGHT ASEAN CITATION INDEX 2014</span><br />
ACI Secretariat: c/o 5th Floor, School of Energy Environment and Materials, King Mongkut’s University of Technology Thonburi<br />
126 Prachautid Road, Bangmod, Thung Khru, Bangkok 10140, Thailand<br />
Tel. and Fax +66 2470 8647 Email: aci.cites@gmail.com</div>
	</div>
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
// 		    cursor: "pointer"
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

    jQuery('div.country-list li').mouseenter(function(){
		jQuery(this).find('a').css('color', 'white');
    });
    jQuery('div.country-list li').mouseleave(function(){
		jQuery(this).find('a').css('color', 'inherit');
    });

    jQuery('div.country-button').click(function(){
		jQuery('div.country-list').toggle('fade', {}, 200);
    });
});
</script>