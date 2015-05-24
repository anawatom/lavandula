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

$this->beginPage();
AppAsset::register($this);

// if (Yii::$app->user->identity == "") {
//echo '<script type="text/javascript">alert("'.(empty(Yii::$app->user->identity->IS_LDAP_AUTHEN)?'':Yii::$app->user->identity->IS_LDAP_AUTHEN).'");</script>';
if (!Authentication::isLoggedIn()) {
    
?><!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <link rel="shortcut icon" type="image/ico" href="<?php echo Url::to('@web/images/favicon.ico'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>E-Warning System</title>
    <?php $this->head() ?>
</head>
<body class="container-content">

<?php
	//Get all flash messages and loop through them
	foreach (Yii::$app->session->getAllFlashes() as $message) {
		echo Growl::widget([
			'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
			// 'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
			// 'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
			'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
			'showSeparator' => true,
			'delay' => 500, //This delay is how long before the message shows
			'pluginOptions' => [
				'showProgressbar' => true,
				'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
				'placement' => [
					'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
					'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
				]
			]
		]);
    }
?>

<?php 
	$nosuuportbrowser = '<div style="-webkit-border-radius: 5px;border-radius: 5px;  margin: 0 15px;border: 1px solid red;background-color: linen;padding: 20px;">Browser version นี้ไม่สามารถใช้งานได้ กรุณาใช้ Browser ที่รองรับ HTML5 หรือดาวน์โหลดได้ที่นี่ <a href="https://www.google.com/chrome/browser/desktop/index.html?system=true&standalone=1">คลิก</a></div>';
?>
<!--[if lt IE 7 ]><?=$nosuuportbrowser?><![endif]-->
<!--[if IE 7 ]><?=$nosuuportbrowser?><![endif]-->
<!--[if IE 8 ]><?=$nosuuportbrowser?><![endif]-->

<noscript>
	<div style="-webkit-border-radius: 5px;border-radius: 5px;  margin: 0 15px;border: 1px solid red;background-color: linen;padding: 20px;">ไม่ Support Javascript กรุณาเปิดการใช้งาน Javascript!!! <!-- <br />กรุณาใช้ Browser อื่น<br />ดาวน์โหลดได้ที่ <a href="https://www.google.com/chrome/browser/desktop/index.html?system=true&standalone=1">คลิก</a> --></div>
</noscript>
<?php echo $content; ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<?php 
}
else{
include(dirname(__FILE__).'/../layouts/menu.php');
}
 ?>
