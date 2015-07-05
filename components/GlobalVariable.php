<?php

/**
 * GlobalVariable is static class to set the global variable for use in app.
 *
 * @author Anawat Onmee <anawat.om@gmail.com>
 * @since 1.0
 */

namespace app\components;

use Yii;
use yii\helpers\StringHelper;
use app\models\CttStaticdataCountrys;

class GlobalVariable {

	private static $fieldName = [
									'staticdata_countrys' => [
																'name'
															]
								];

	public static function fetchData() {
		foreach (self::$fieldName as $key => $value) {
			$splitKey = StringHelper::explode($key, '_');
			if ($key == 'staticdata_countrys') {
				$data = CttStaticdataCountrys::find()->all();
			}

			foreach ($value as $valueKey => $valueValue) {
				foreach ($data as $dataKey => $dataValue) {
					Yii::$app->params[$splitKey[0]][$splitKey[1]][$dataValue->id][$dataValue->lang_id][$valueValue] = $dataValue->$valueValue;
				}
			}
		}
	}

	public static function clearData() {
		foreach (self::$fieldName as $key => $value) {
			$splitKey = StringHelper::explode($key, '_');

			Yii::$app->params[$splitKey[0]][$splitKey[1]] = '';
		}
	}

}