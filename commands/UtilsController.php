<?php

/**
 * See in
 *  https://github.com/yiisoft/yii2/blob/master/docs/guide/tutorial-console.md
 *
 */

namespace app\commands;

use Yii;
use yii\console\Controller;

class UtilsController extends Controller
{
    public function actionCreateUser()
    {
		$user = new \app\Models\User();
        $user->role_id = '1';
        $user->username = 'superadmin';
        $user->email = 'superadmin@email.com';
        $user->password = sha1('password');
        $user->status = '1';
        $user->generateAuthKey();
        $user->save(false);

        // the following three lines were added:
        $auth = \Yii::$app->authManager;
        $superadmin = $auth->getRole('superadmin');
        $auth->assign($superadmin, $user->getId());
    }
}