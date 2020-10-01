<?php

namespace frontend\controllers;

use common\models\Messages;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class MessagesController extends Controller
{
    public function actionBlock($id)
    {
        if ($model = Messages::findOne($id)) {;
            $model->status = 9;
            $model->update(false);
            Yii::$app->response->setStatusCode(201);
        } else {
            Yii::$app->response->setStatusCode(404);
        }
    }

    public function actionUnBlock($id)
    {
        if ($model = Messages::findOne($id)) {
            $model->status = 10;
            $model->update(false);
            Yii::$app->response->setStatusCode(201);
        } else {
            Yii::$app->response->setStatusCode(404);
        }

    }
}
