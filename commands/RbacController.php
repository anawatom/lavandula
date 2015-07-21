<?php

/**
 * See in 
 *  https://github.com/yiisoft/yii2/blob/master/docs/guide/security-authorization.md
 *
 */

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add "createData" permission
        $createData = $auth->createPermission('createData');
        $createData->description = 'Create a data';
        $auth->add($createData);

        // add "updateData" permission
        $updateData = $auth->createPermission('updateData');
        $updateData->description = 'Update a data';
        $auth->add($updateData);

        // add "operation" role and give this role the "createData" permission
        $operation = $auth->createRole('operation');
        $auth->add($operation);
        $auth->addChild($operation, $createData);

        // add "administrator" role and give this role the "updateData" permission
        // as well as the permissions of the "author" role
        $administrator = $auth->createRole('administrator');
        $auth->add($administrator);
        $auth->addChild($administrator, $updateData);
        $auth->addChild($administrator, $operation);

        // add "superadmin" role and give this role the "administrator" permission
        // as well as the permissions of the "author" role
        $superadmin = $auth->createRole('superadmin');
        $auth->add($superadmin);
        $auth->addChild($superadmin, $administrator);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($superadmin, 1);
        $auth->assign($administrator, 2);
        $auth->assign($operation, 3);
    }
}