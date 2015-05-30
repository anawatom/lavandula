<?php

namespace yii\web;

class AppController extends Controller
{
	public $title = 'ACI';
	
	public function handlerError($ex) {
		Yii::error($ex->getMessage(), 'Application Debug');
	
		/**
			* Use yii2-widget-growl
			* See in https://github.com/kartik-v/yii2-widget-growl
		*/
		Yii::$app->getSession()->setFlash('success', [
				'type' => Growl::TYPE_DANGER,
				'duration' => 3000,
				'message' => 'message',
		]);
	}
}
