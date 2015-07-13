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
	public $title = 'ACI';
	
// 	public function actions()
// 	{
// 		return [
// 				'error' => [
// 						'class' => 'yii\web\ErrorAction',
// 				]];
				
// 	}
	

	public function init()
    {
   //      parent::init();

   //      $language = \Yii::$app->session->get('app.language');
   //      if ($language) {
			// Yii::$app->language = $language;
   //      }
    }

    public function actionIndex()
    {
    	$this->layout = 'home';
		try {
			// this is a error code
			//$result = WA_PROVINCE::find()->where('aaaaaaaaaaaaaaaaaaaaaaaaa', aaa);
		//TESTSSETET 
		} 
		catch (ErrorException $e) {
			$this->handlerError($e);
		}
		finally {
			return $this->render('index');
		}
    }
	
    public function actionSite()
    {
		try {
			
			
		}
		catch (ErrorException $e) {
			$this->handlerError($e);
		}
		finally {
			return $this->render('site');
		}
    }

    public function actionSetLanguage() {
		try {
			$request = \Yii::$app->getRequest();

			$lang = $request->getQueryParam('lang');
			$current_url = $request->getQueryParam('current_url');
			\Yii::$app->session->set('app.language', $lang);
		}
		catch (ErrorException $e) {
			$this->handlerError($e);
		}

		return $this->redirect($current_url);
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
