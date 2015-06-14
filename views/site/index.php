<?php 
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\web\Session;


AppAsset::register($this);
	\Yii::$app->getResponse()->redirect(['home/index']);
