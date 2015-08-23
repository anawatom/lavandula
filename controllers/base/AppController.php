<?php

namespace app\controllers\base;

use yii;
use app\models\CttStaticdataLanguages;

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
	
	protected function getLanguages(){
		$languages = CttStaticdataLanguages::find()->select(['id', 'name'])->all();
		$output = [];
		
		foreach($languages as $language){
			$output[$language->id] = $language->name;
		}
		
		return $output;
		
	}
	
}
