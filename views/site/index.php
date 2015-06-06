<?php 
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\web\Authentication;
use yii\web\Session;


AppAsset::register($this);
if (!Authentication::isLoggedIn()) {
	\Yii::$app->getResponse()->redirect(['home/index']);
}

?>
<div style="padding:0 10px;">
<?php 
	include "annoucement.php";
?>
</div>