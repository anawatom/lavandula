<?php

namespace app\controllers;

use yii;
use yii\base\ErrorException;
use yii\helpers\Html;
use yii\web\Session;
use kartik\growl\Growl;
use app\models\CttArticles;

class HomeController extends base\AppController
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
		
			//SELECT COUNT(1) as volume FROM (SELECT COUNT(1) AS volume FROM `ctt_articles` GROUP BY `id`) t1
			$connection = Yii::$app->db;
			
			$article_count = $connection
			->createCommand('SELECT COUNT(1) as cnt FROM (SELECT COUNT(1) AS volume FROM `ctt_articles` GROUP BY `id`) t1')->queryAll();
			$this->setParameter('article_count',$article_count[0]['cnt']);
			
			$recently_articles = CttArticles::recently();
			$this->setParameter('recently_articles', $recently_articles->getModels());
			
		} 
		catch (ErrorException $e) {
			$this->handlerError($e);
		}
		return $this->cRender('index');
    }
	
    public function actionSite()
    {
		try {
			
			
		}
		catch (ErrorException $e) {
			$this->handlerError($e);
		}
		return $this->render('site');
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
