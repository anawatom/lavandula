<?php

/**
 * See more
 *  https://github.com/yiisoft/yii2/blob/master/docs/guide/security-authorization.md
 *
 * How to run this file.
 *  Run yii rbac/init in the command line.
 */

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();

        /***
        * The template for adding the permission/
        * $createData = $auth->createPermission('createData');
        * $createData->description = 'Create a data';
        * $auth->add($createData);
        */

        $articleImport = $auth->createPermission('articleImport');
        $articleImport->description = 'Article Import';
        $auth->add($articleImport);

        $articleApproval = $auth->createPermission('articleApproval');
        $articleApproval->description = 'Article Approval';
        $auth->add($articleApproval);

        $userManagement = $auth->createPermission('userManagement');
        $userManagement->description = 'User Management';
        $auth->add($userManagement);

        $articleManagement = $auth->createPermission('articleManagement');
        $articleManagement->description = 'Article Management';
        $auth->add($articleManagement);

        $issueManagement = $auth->createPermission('issueManagement');
        $issueManagement->description = 'Issue Management';
        $auth->add($issueManagement);

        $authorManagement = $auth->createPermission('authorManagement');
        $authorManagement->description = 'Author Management';
        $auth->add($authorManagement);

        $journalManagement = $auth->createPermission('journalManagement');
        $journalManagement->description = 'Journal Management';
        $auth->add($journalManagement);

        $publisherManagement = $auth->createPermission('publisherManagement');
        $publisherManagement->description = 'Publisher Management';
        $auth->add($publisherManagement);

        $countryManagement = $auth->createPermission('countryManagement');
        $countryManagement->description = 'Country Management';
        $auth->add($countryManagement);

        $languageManagement = $auth->createPermission('languageManagement');
        $languageManagement->description = 'Language Management';
        $auth->add($languageManagement);

        $subjectAreaManagement = $auth->createPermission('subjectAreaManagement');
        $subjectAreaManagement->description = 'Subject Area Management';
        $auth->add($subjectAreaManagement);

        $affiliationManagement = $auth->createPermission('affiliationManagement');
        $affiliationManagement->description = 'Affiliation Management';
        $auth->add($affiliationManagement);

        $organizationManagement = $auth->createPermission('organizationManagement');
        $organizationManagement->description = 'Organization Management';
        $auth->add($organizationManagement);

        $documentTypeManagement = $auth->createPermission('documentTypeManagement');
        $documentTypeManagement->description = 'Document Type Management';
        $auth->add($documentTypeManagement);

        $pageContentManagement = $auth->createPermission('pageContentManagement');
        $pageContentManagement->description = 'Page Content Management';
        $auth->add($pageContentManagement);

        /***
        * The template for adding the role/
        * $operation = $auth->createRole('operation');
        * $auth->add($operation);
        * $auth->addChild($operation, $createData);
        */

        $operation = $auth->createRole('operation');
        $auth->add($operation);
        $auth->addChild($operation, $articleImport);

        $administrator = $auth->createRole('administrator');
        $auth->add($administrator);
        $auth->addChild($administrator, $operation);
        $auth->addChild($administrator, $articleImport);

        $superAdministrator = $auth->createRole('superAdministrator');
        $auth->add($superAdministrator);
        $auth->addChild($superAdministrator, $operation);
        $auth->addChild($superAdministrator, $administrator);
        $auth->addChild($superAdministrator, $userManagement);
        $auth->addChild($superAdministrator, $articleManagement);
        $auth->addChild($superAdministrator, $issueManagement);
        $auth->addChild($superAdministrator, $authorManagement);
        $auth->addChild($superAdministrator, $journalManagement);
        $auth->addChild($superAdministrator, $publisherManagement);
        $auth->addChild($superAdministrator, $countryManagement);
        $auth->addChild($superAdministrator, $languageManagement);
        $auth->addChild($superAdministrator, $subjectAreaManagement);
        $auth->addChild($superAdministrator, $affiliationManagement);
        $auth->addChild($superAdministrator, $organizationManagement);
        $auth->addChild($superAdministrator, $documentTypeManagement);
        $auth->addChild($superAdministrator, $pageContentManagement);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($superAdministrator, 1);
        $auth->assign($administrator, 2);
        $auth->assign($operation, 3);
    }
}