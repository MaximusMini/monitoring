<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'VK добавить аккаунт';
?>
<div class="container">
    <?php if ($labels && !$account_info): ?>
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($labels, 'url') ?>
        <?= Html::submitButton('Просмотреть', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end(); ?>
    <?php elseif ($labels && $account_info): ?>
        <div class="info">
            <h2 class="alert alert-success">Это ваш аккаунт?</h2>
            <img class="logo" src="<?= $account_info['photo_200'] ?>">
            <h2 class="name"><?= $account_info['first_name'] . ' ' . $account_info['last_name'] ?></h2>
            <p>Страна: <?= $account_info['country']['title'] ?></p>
            <p>Город: <?= $account_info['city']['title'] ?></p>
            <p>Статус: <?= $account_info['status'] ?></p>
            <?php $form = ActiveForm::begin(['options' => ['class' => 'inline']]); ?>
            <?= $form->field($labels, 'name')->hiddenInput(['value' => ($account_info['first_name'] . ' ' . $account_info['last_name'])])->label(false); ?>
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end(); ?>
            <?php $form = ActiveForm::begin(['options' => ['class' => 'inline']]); ?>
            <?= $form->field($labels, 'name')->hiddenInput(['value' => 'DELETE'])->label(false); ?>
            <?= $form->field($labels, 'group_id')->hiddenInput(['value' => $account_info['id']])->label(false); ?>
            <?= Html::submitButton('Отмена', ['class' => 'btn btn-secondary']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    <?php endif; ?>
</div>