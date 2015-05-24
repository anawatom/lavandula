<?php

namespace app\controllers;

use yii;
use yii\base\ErrorException;
use yii\helpers\Html;
use yii\web\Session;
use kartik\growl\Growl;
use app\models\WA_PROVINCE;

class HomeController extends \yii\web\Controller
{
    public function actionIndex()
    {
		try {
			// this is a error code
			$result = WA_PROVINCE::find()->where('aaaaaaaaaaaaaaaaaaaaaaaaa', aaa);
		}
		catch (ErrorException $e) {
			$this->handlerError($e);
		}
		finally {
			return $this->render('index');
		}
    }

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
