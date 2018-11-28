<?php

/* @var $this yii\web\View */

$this->title = 'VK';
?>
<div class="container">
    <div class="sidebar">
        <h2 class="setting">Настройка</h2>
        <a href="<?= Yii::$app->urlManager->createUrl(['vk/group_settings']) ?>" class="myBtn">
            <button class="btn btn-primary">Набор групп</button>
        </a>
        <a href="<?= Yii::$app->urlManager->createUrl(['vk/add_group']) ?>" class="myBtn">
            <button class="btn btn-primary">Добавить группу</button>
        </a>
        <a href="<?= Yii::$app->urlManager->createUrl(['vk/account_settings']) ?>" class="myBtn">
            <button class="btn btn-primary">Набор аккаунтов</button>
        </a>
    </div>
    <div class="content">
        <h2 class="alert alert-success">Мониторинг групп</h2>

        <a href="<?= Yii::$app->urlManager->createUrl(['vk/monitoring-day']) ?>" class="btn btn-info">
        За день
        
        </a>
        <button class="btn btn-info">За неделю</button>
        <button class="btn btn-info">За период</button>
    </div>
    <div class="content">
        <h2 class="alert alert-success">Мониторинг аккаунтов</h2>
        <button class="btn btn-info">За день</button>
        <button class="btn btn-info">За неделю</button>
        <button class="btn btn-info">За период</button>
    </div>
</div>
