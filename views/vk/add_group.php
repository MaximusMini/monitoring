<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'VK добавить группу';
?>
<div class="container">
    <?php if ($group_info): ?>
        <div class="info">
            <h2 class="alert alert-success">Это ваша группа?</h2>
            <img class="logo" src="<?= $group_info['photo_200'] ?>">
            <h2 class="name"><?= $group_info['name'] ?></h2>
            <p>Страна: <?= $group_info['country']['title'] ?></p>
            <p>Город: <?= $group_info['city']['title'] ?></p>
            <p>Количество участников: <?= $group_info['members_count'] ?></p>
            <p>Описание: </p>
            <?php if ($group_info['description']): ?>
                <pre><?= $group_info['description'] ?></pre>
            <?php else: ?>
                <pre>Описание отсутствует</pre>
            <?php endif; ?>
            <?php $form = ActiveForm::begin(['options' => ['class' => 'inline']]); ?>
            <?= $form->field($labels, 'name')->hiddenInput(['value' => $group_info['name']])->label(false); ?>
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end(); ?>
            <?php $form = ActiveForm::begin(['options' => ['class' => 'inline']]); ?>
            <?= $form->field($labels, 'name')->hiddenInput(['value' => 'DELETE'])->label(false); ?>
            <?= $form->field($labels, 'group_id')->hiddenInput(['value' => $group_info['id']])->label(false); ?>
            <?= Html::submitButton('Отмена', ['class' => 'btn btn-secondary'])?>
            <?php ActiveForm::end(); ?>
        </div>
    <?php else: ?>
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($labels, 'url') ?>
        <?= Html::submitButton('Просмотреть', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end(); ?>
    <?php endif; ?>
</div>