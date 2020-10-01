<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use common\models\Messages;
use common\models\User;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Admin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <section class="col-md-6">
        <table class="table">
            <thead>
            <tr>
                <td>Username</td>
                <td>Email</td>
                <td>Role</td>
            </tr>
            </thead>
            <tbody>
            <?php /** @var User $users */
            foreach ($users as $user) { ?>
                <tr>
                    <td><?= $user->username ?></td>
                    <td><?= $user->email ?></td>
                    <td>
                        <span class="badge auth-item"><?= $user->authAssignment->item_name ?></span>
                    </td>
                    <td>
                        <button data-user_id="<?= $user->id ?>"
                                class="btn btn-sm <?= User::isBlocked($user) ? 'changed-role btn-danger' : 'change-role btn-primary' ?>">
                            <?= User::isBlocked($user) ? 'Change back' : 'Change role' ?>
                        </button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </section>
    <section class="col-md-6">
        <table class="table">
            <thead>
            <tr>
                <td>User</td>
                <td>Content</td>
            </tr>
            </thead>
            <tbody>
            <?php /** @var \common\models\Messages $messages */
            foreach ($messages as $sms) { ?>
                <tr>
                    <td><?= $sms->user->username ?></td>
                    <td><?= mb_strimwidth($sms->content, 0, 100, '...') ?></td>
                    <td>
                        <button class="btn btn-sm <?= Messages::isBlocked($sms) ? 'blocked btn-success' : 'block btn-danger' ?>"
                                data-message_id='<?= $sms->id; ?>'>
                            <?= Messages::isBlocked($sms) ? 'Unblock' : 'Block' ?>
                        </button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </section>
</div>
