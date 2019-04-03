<?php

use yii\db\Migration;
use yii\db\Query;
use yii\rbac\Role;

/**
 * Class m190402_225818_init_rbac
 */
class m190402_225818_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $authManager = Yii::$app->authManager;

        $admin = $authManager->createRole('admin');
        $admin->description = 'Admin';
        $authManager->add($admin);

        $operator = $authManager->createRole('operator');
        $operator->description = 'Operator';
        $authManager->add($operator);

        $createService = $authManager->createPermission('createService');
        $createService->description = 'Can create a service';
        $authManager->add($createService);

        $authManager->addChild($admin, $createService);

        $toggleService = $authManager->createPermission('toggleService');
        $toggleService->description = 'Can toggle a service';
        $authManager->add($toggleService);

        $authManager->addChild($admin, $toggleService);

        $updateOtherServiceParams = $authManager->createPermission('updateOtherServiceParams');
        $updateOtherServiceParams->description = 'Can update other params of service';
        $authManager->add($updateOtherServiceParams);

        $authManager->addChild($admin, $updateOtherServiceParams);
        $authManager->addChild($operator, $updateOtherServiceParams);

        $viewServiceLog = $authManager->createPermission('viewServiceLog');
        $viewServiceLog->description = 'Can view log of service';
        $authManager->add($viewServiceLog);

        $authManager->addChild($admin, $viewServiceLog);
        $authManager->addChild($operator, $viewServiceLog);

        $adminUserId = (new Query())
            ->select('id')
            ->from('{{%user}}')
            ->where(['username' => 'admin'])
            ->scalar();

        $authManager->assign($admin, $adminUserId);

        $operatorUserId = (new Query())
            ->select('id')
            ->from('{{%user}}')
            ->where(['username' => 'operator'])
            ->scalar();
        
        $authManager->assign($admin, $operatorUserId);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $authManager = Yii::$app->authManager;

        $authManager->remove($authManager->getRole('admin'));
        $authManager->remove($authManager->getRole('operator'));
        $authManager->remove($authManager->getPermission('createService'));
        $authManager->remove($authManager->getPermission('toggleService'));
        $authManager->remove($authManager->getPermission('updateOtherServiceParams'));
        $authManager->remove($authManager->getPermission('viewServiceLog'));

    }
}
