<?php

namespace app\controllers;

use yii;
use yii\base\ErrorException;
use yii\helpers\Html;
use yii\web\Session;
use app\models\CttPageContents;

class ContentsController extends base\AppController
{

    public function actionIndex($id)
    {
    	$this->layout = 'home';
		try {
			if(empty($id)) throw new Exception("Require Parameter id");
			
			$pageContent = CttPageContents::find()->select(['id', 'lang_id', 'name', 'contents'])->where(['id' => $id, 'lang_id' => 1])->one();
			$this->setParameter('pageContent', $pageContent);
			
		} 
		catch (ErrorException $e) {
			$this->handlerError($e);
		}
		return $this->cRender('index');
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
