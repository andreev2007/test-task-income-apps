<?php


namespace common\models;


use Yii;

class AssignRole
{
    public function __construct($role, $userId)
    {
        $auth = Yii::$app->authManager;

        $auth->assign($role, $userId);
    }
}
