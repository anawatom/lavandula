<?php

/**
 * FlashMessage is static class to show a flash message using yii2-widget-growl.
 *
 * So this class will set session variables for the Growl::widget options
 * and then the Growl::widget will use these variables to create a flash message 
 * in the layout page.
 *
 * For yii2-widget-growl See in https://github.com/kartik-v/yii2-widget-growl.
 *
 * @author Anawat Onmee <anawat.om@gmail.com>
 * @since 1.0
 */

namespace app\components;

use Yii;
use kartik\growl\Growl;

class FlashMessage
{
	private static $duration = 10000;
	private static $showSeparator = false;
	private static $delay = 300;

	public static function showSuccess($options) {
		Yii::$app->getSession()->setFlash('success', [
			'type' => Growl::TYPE_SUCCESS,
			'duration' => self::$duration,
			'title' => 'Success',
			'showSeparator' => self::$showSeparator,
			'icon' => 'glyphicon glyphicon-ok-sign',
			'message' => $options['msg'],
			'delay' => self::$delay,
		]);
	}

	public static function showError($options) {
		Yii::$app->getSession()->setFlash('success', [
			'type' => Growl::TYPE_DANGER,
			'duration' => self::$duration,
			'title' => 'Error',
			'showSeparator' => self::$showSeparator,
			'icon' => 'glyphicon glyphicon-exclamation-sign',
			'message' => $options['msg'],
			'delay' => self::$delay,
		]);
	}

}