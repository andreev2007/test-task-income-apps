<?php

namespace frontend\controllers;

use common\models\AssignRole;
use common\models\AuthAssignment;
use common\models\Messages;
use common\models\User;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Session;

/**
 * Site controller
 */
class AdminController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionUpdateUser($id)
    {
        $user = User::findOne($id);

        $user->load(Yii::$app->request->post());
        $user->save();

        return $this->render('update_user', [
            'user' => $user,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $users = User::find()->where(['status' => User::STATUS_ACTIVE])->andWhere(['<>', 'id', Yii::$app->user->id])->all();
        $messages = Messages::find()->where(['status' => User::STATUS_INACTIVE])->all();
        $message = new Messages();

        $message->load(Yii::$app->request->post());
        $message->save();

        Yii::error($message);

        return $this->render('index', [
            'users' => $users,
            'messages' => $messages,
            'message' => $message,
        ]);
    }


    public function actionChangeRole($user_id)
    {
        $model = User::findOne($user_id);
        $authManager = Yii::$app->authManager;
        $authManager->revokeAll($model->id);
        $admin = $authManager->getRole('admin');
        $authManager->assign($admin, $model->id);
        Yii::$app->response->setStatusCode(201);
    }

    public function actionUnChangeRole($user_id)
    {
        $model = User::findOne($user_id);
        $authManager = Yii::$app->authManager;
        $authManager->revokeAll($model->id);
        $admin = $authManager->getRole('user');
        $authManager->assign($admin, $model->id);
        Yii::$app->response->setStatusCode(201);

    }
}
