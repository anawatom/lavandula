<?php

namespace app\controllers\base;

use yii;

class AppController extends \yii\web\Controller
{
	public $layout = 'home';
	public $title = 'ACI';
	public $parameter=[];
	
	protected function setParameter($name, $data){
		$this->parameter[$name] = $data;
	}
	protected function cRender($view){
		return $this->render($view, $this->parameter);
	}
	
}
