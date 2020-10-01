<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;

// Создание админа
class RbacController extends Controller
{
    public function actionInit()
    {

        $auth = Yii::$app->authManager;

        $admin = $auth->createRole('admin');
        $user =  $auth->createRole('user');
        if (!$auth->getRole('admin')) $auth->add($admin); else $this->stderr('ROLE admin exists');
        if (!$auth->getRole('user')) $auth->add($user); else $this->stderr('ROLE admin exists');


        //  Yii::$app->db->createCommand()->truncateTable('users')->execute();
        $user = User::findOne(['email' => 'admin@admin.com']) ?: new User();
        $user->username = 'admin';
        $user->email = 'admin@admin.com';
        $user->status = 10;
        $user->setPassword('admin');
        $user->generateAuthKey();
        $user->save();


        // add "admin" role and give this role the "managePoint" permission
        // as well as the permissions of the "owner" role


    }

    /**
     * @throws \Exception
     */

    public function actionAddAdmin()
    {
        $user = new User(['email' => $this->prompt('email:'), 'status' => 10]);
        $user->setPassword($this->prompt('password'));
        $user->generateAuthKey();
        $user->save();
        $auth = Yii::$app->authManager;
        $auth->assign($auth->getRole('admin'), $user->id);
    }
}
