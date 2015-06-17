<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class UtilsController extends Controller
{
    public function actionCreateUser()
    {
		$user = new \app\Models\User();
        $user->role_id = '3';
        $user->username = 'operation';
        $user->email = 'operation@email.com';
        $user->password = sha1('password');
        $user->status = '1';
        $user->generateAuthKey();
        $user->save(false);

        // the following three lines were added:
        $auth = \Yii::$app->authManager;
        $operation = $auth->getRole('operation');
        $auth->assign($operation, $user->getId());
    }
}