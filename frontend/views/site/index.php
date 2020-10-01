<?php

/* @var $this yii\web\View */

use common\models\Messages;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Chat';
?>
<div class="row" style="margin-top: 3rem;">
    <div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading top-bar">
                <div class="col-md-8 col-xs-8">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-book"></span> Contacts</h3>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <tbody>
                <?php /** @var \common\models\User $users */
                foreach ($users as $user) { ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->username ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="col-sm-8">
        <div class="chatbody">
            <div class="panel panel-primary">
                <div class="panel-heading top-bar">
                    <div class="col-md-8 col-xs-8">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Chat</h3>
                    </div>
                </div>
                <div class="panel-body msg_container_base">
                    <div class="msg_container base_receive">
                        <?php /** @var Messages $messages */
                        foreach ($messages as $sms) { ?>
                            <div class="col-md-12">
                                <div class="messages msg_receive">
                                    <p><?= $sms->content ?></p>

                                    <?php /** @var User $currentUser */
                                    if ($currentUser->authAssignment->item_name === 'admin') { ?>
                                        <button class="btn btn-sm <?= Messages::isBlocked($sms) ? 'blocked btn-success' : 'block btn-danger' ?>"
                                                data-message_id='<?= $sms->id; ?>'>
                                            <?= Messages::isBlocked($sms) ? 'Unblock' : 'Block' ?>
                                        </button>
                                    <?php } ?>

                                    <?php if ($sms->user->authAssignment->item_name === 'admin') { ?>
                                        <div>
                                            <em><strong style="font-size: 12px;color: red">ADMIN</strong></em>
                                        </div>

                                    <?php } else { ?>
                                        <div>
                                            <em><strong style="font-size: 10px;"><?= $sms->user->username ?></strong></em>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <?php if (!Yii::$app->user->isGuest) { ?>
                    <div class="panel-footer">
                        <div class="input-group">
                            <?php $form = ActiveForm::begin([
                                'options' => ['style' => 'display: flex;']
                            ]) ?>
                            <?= /** @var Messages $message */
                            $form->field($message, 'content')->
                            textarea(['class' => 'form-control input-sm chat_input', 'placeholder' => 'Type a message', 'rows' => 5,'cols' => 80])->label(false) ?>

                            <span class="input-group-btn">
                            <?= Html::submitButton('Send', ['class' => 'btn btn-primary btn-sm']) ?>
                        </span>

                            <?php ActiveForm::end() ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
