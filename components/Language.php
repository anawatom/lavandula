<?php

namespace app\components;

use yii;
use yii\base\Component;

class Language extends Component
{
	public function init()
	{
		parent::init();

        $language = \Yii::$app->session->get('app.language');
        if ($language) {
			Yii::$app->language = $language;
        }
	}
}