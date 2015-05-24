<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\web\Authentication;
use himiklab\jqgrid\JqGridWidget;

/* @var $this \yii\web\View */
/* @var $content string */
$this->title='DPE E-Warning System - '.$this->context->title;
$this->beginPage();
AppAsset::register($this);
$this->registerJs("$('#menu2').metisMenu({toggle:false});");

?><!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie6" lang="<?= Yii::$app->language ?>"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" lang="<?= Yii::$app->language ?>"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8" lang="<?= Yii::$app->language ?>"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9" lang="<?= Yii::$app->language ?>"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="" lang="<?= Yii::$app->language ?>"> <!--<![endif]-->

<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <link rel="shortcut icon" type="image/ico" href="<?php echo Url::to('@web/images/favicon.ico'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script type="text/javascript">
    
    	var APP = {};
	    APP.ajaxAction = {
	        	getProvince: '<?=Url::to(['common/getddlprovince']);?>',
	        	getAmphoe: '<?=Url::to(['common/getddlampore']);?>',
	        	uploadAnnoucementImg: '<?=Url::to(['waannouncement/uploadimg']);?>'
	        };

        APP.path = {
				nicEditorButtons: '<?=Yii::$app->request->baseUrl?>/assets/nicEdit/nicEditorIcons.gif'
        	};
    </script>
    <?php $this->head() ?>
    
    <style type="text/css">
        .ui-jqgrid .ui-jqgrid-view, .ui-jqgrid .ui-jqgrid-titlebar{
            font-size: 15px;
        }
        .ui-jqgrid {
            margin: auto;
        }
        .ui-jqgrid tr.jqgrow, .ui-jqgrid tr.ui-jqgrid-labels, div.ui-jqgrid-titlebar{
            height:40px;
        }
        .ui-jqgrid .ui-jqgrid-view input, .ui-jqgrid .ui-jqgrid-view select, .ui-jqgrid .ui-jqgrid-view textarea, .ui-jqgrid .ui-jqgrid-view button{
            font-size:15px;
        }
        .ui-jqgrid .ui-jqgrid-view textarea{
            margin-top: 5px;
        }
        .ui-jqgrid .ui-jqgrid-pager{
            height: 35px;
            font-size: 14px;
        }
        .ui-jqgrid .ui-pg-input{
            height: 25px;
            font-size: 14px;
        }
        .ui-jqgrid .ui-pg-selbox{
            height: 25px;
            font-size: 14px;
        }
        .ui-jqgrid .ui-jqgrid-hdiv, .ui-jqgrid .ui-jqgrid-titlebar, .ui-jqgrid .ui-jqgrid-pager{
            width:99.8%;
        }
        .ui-jqgrid .ui-jqgrid-titlebar{
        	padding-top:.6em;
        }
        .myAltRowClassEven { background: #F7F7F7; }
        input{
            color: #000;
        }
        #pagered span.glyphicon{
            padding: 2px 5px;
            font-size: 20px;
        }
        td.ltr{
            padding-top:4px;
        }
        div.modal-dialog{
            margin-top: 15%;
        }
        .ui-jqdialog{
        	font-size:14px;
        }
        .ui-jqdialog-content td.EditButton{
        	text-align:center;
        }
        legend{
            margin-bottom:5px;
        }
        .form-group{
            margin-bottom: 0px;
        }
        .form-filtering .form-group{
            padding: 0 0 10px 0;
        }
        select{
        	color: black;
        }
        .ui-jqgrid .ui-jqgrid-htable th div{
        	height: initial;
        }
        .form-horizontal .form-group{
        	margin-left: 0px;
        	margin-right: 0px;
        }

        /* Style for flag message */
        #flagMessage {
            position: fixed;
            top: 30px;
            left: 0;
            right: 0;
            height: 0;
            text-align: center;
            z-index: 1001;
        }
        #flagMessage .message {
            padding: 5px;
            color: black;
            background-color: #FAFAFA;
            border: 0.75px solid white;
            border-left: 5px solid white;
            font-size: 1.25em;
        }
        #flagMessage .message.error{
            color: red;
            border: 0.75px solid red;
            border-left: 5px solid red;
        }
        #flagMessage .message.success{
            color: green;
            border: 0.75px solid green;
            border-left: 5px solid green;
        }
        table.ui-jqgrid-htable tr.ui-jqgrid-labels input.cbox{
        	display: none;
        }
    </style>
</head>
<body onbeforeunload="loading();">
    <?php $this->beginBody() ?>
	<?php
		$alertmessage = Yii::$app->getRequest()->getQueryParam('alertmessage');
		if(!empty($alertmessage)) echo '<script type="text/javascript">BootstrapDialog.alert("'.base64_decode($alertmessage).'");</script>';
	?>
	<div class="header" id="headerSection">
	    <div class="header-left-label"></div>
	    <div class="logo"></div>
	    <div class="banner-linenumber"></div>
	    <div class="header-name"></div>
<!-- 	    <div class="ewarning-icon"></div> -->
	    <div class="header-right-label">
			<div class="set-user">Test User</div>
<!-- 			<div class="logout"><a href="?r=site/signout">Logout</a></div> -->
		</div>
	</div>
<?php 
	$nosuuportbrowser = '<div style="-webkit-border-radius: 5px;border-radius: 5px;  margin: 0 15px;border: 1px solid red;background-color: linen;padding: 20px;">Browser version นี้ไม่สามารถใช้งานได้ กรุณาใช้ Browser ที่รองรับ HTML5 หรือดาวน์โหลดได้ที่นี่ <a href="https://www.google.com/chrome/browser/desktop/index.html?system=true&standalone=1">คลิก</a></div>';
?>
<!--[if lt IE 7 ]><?=$nosuuportbrowser?><![endif]-->
<!--[if IE 7 ]><?=$nosuuportbrowser?><![endif]-->
<!--[if IE 8 ]><?=$nosuuportbrowser?><![endif]-->
	<aside  class="sidebar">
    <div class="sidebar-nav"  id="menu2">
        <div class="menu-header">DPE E-Warning System</div>
	 	<ul>
		<li>TEST MENU</li>
      </ul>
</div>
</aside>
<!-- flash message -->
<div id="flagMessage"></div>
<!-- end flash message -->
<!--div class="content-header"><?=$this->context->title?></div-->
<div class="content">
<noscript>
	<div style="-webkit-border-radius: 5px;border-radius: 5px;  margin: 0 15px;border: 1px solid red;background-color: linen;padding: 20px;">ไม่ Support Javascript กรุณาเปิดการใช้งาน Javascript!!! <!-- <br />กรุณาใช้ Browser อื่น<br />ดาวน์โหลดได้ที่ <a href="https://www.google.com/chrome/browser/desktop/index.html?system=true&standalone=1">คลิก</a> --></div>
</noscript>
    
    <?php echo $content; ?>
    
</div>
<br /><br />
<div id="block-page" class="loading-unblock"><div id="block-page_hdn"></div></div>
<div id="div_loading" class="loading-invisible">
    &nbsp;
    <table border="0" style="margin-left: auto;margin-right: auto;">
        <tr>
            <td align="center" valign="middle">
            		<?php //echo $this->Html->image('loading.gif', array('style'=>'border: 0;')); ?>
            		<?php echo Html::img(Url::to('@web/images/loading.gif')); ?>
            </td>
        </tr>
        <tr>
            <td align="center" valign="middle">
                <font size="2" color="#FFFFFF"><b><span class="message">Loading</span></b></font>
            </td>
        </tr>
    </table>
    &nbsp;
</div>
<?php //$this->endContent() ?>
<?php $this->endBody() ?>



<!-- show flash meassage -->
<?php
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        if ($key == 'error') {
            echo "<script type=\"text/javascript\">BootstrapDialog.alert(\"$message\");</script>";
        } else {
            echo "<script type=\"text/javascript\">Common.utils.showFlashMessage({text:'$message', className:'$key'});</script>";
        }
    }
?>
<!-- end show flash meassage -->
</body>
</html>
<?php $this->endPage() ?>
