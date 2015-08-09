<?php

/**
 * ErrorHelper is static class to handler from exception object.
 *
 * @author Anawat Onmee <anawat.om@gmail.com>
 * @since 1.0
 */

namespace app\helpers;

use yii;
use yii\base\Exception;
use yii\helpers\Url;
use yii\web\Controller;
use kartik\growl\Growl;
use app\components\FlashMessage;

class ErrorHelper extends Exception
{
    public static function handlerError($exception, $redirectTo)
    {
		Yii::error($exception->getMessage(), 'Application Debug');

		FlashMessage::showError(['msg' => $exception->getMessage()]);

		if (!empty($redirectTo)) {
			Controller::redirect(Url::to($redirectTo));
		}
    }

    /**
    * This function is used to show error in create and update view
    * that using kartik\detail\DetailView. So the error will be shown
    * in the same page.
    */
    public static function showErrorForCU($exception, $redirectTo)
    {
		Yii::error($exception->getMessage(), 'Application Debug');

		Yii::$app->session->setFlash('kv-detail-error', $exception->getMessage());

		if (!empty($redirectTo)) {
			Controller::redirect(Url::to($redirectTo));
		}
    }

    /**
    * This function will throw the Exception object that has an formatted error string
    * when the ActiveRecord has failed to validate data after saving or updating the data.
    */
    public static function throwActiveRecordError($errors)
    {
        $strError = '';

        foreach ($errors as $key => $values) {
            $strError .= $key.': ';

            foreach ($values as $key => $value) {
                $strError .= $value.'<br>';
            }
        }

        throw new Exception($strError);
    }
}