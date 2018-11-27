<?php
use yii\grid\GridView;

$this->title = 'VK набор аккаунтов';
?>
<div class="container">
    <?php if ($accounts): ?>
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <?php echo Yii::$app->session->getFlash('success'); ?>
            </div>
        <?php endif; ?>
        <h2 class="alert alert-success">Список аккаунтов</h2>
        <a href="<?= Yii::$app->urlManager->createUrl(['vk/add_account']) ?>" class="myBtn">
            <button class="btn btn-primary">Добавить аккаунт</button>
        </a>
        <button class="btn btn-primary" id="delete" disabled onclick="deleteCheckedGroup()">Удалить выбранные</button>
        <div class="padding">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'checkboxOptions' => [
                            'onchange' => 'getCheckedGroup()',
                            'class' => 'grid',
                        ],
                    ],
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'photo_50',
                        'label' => 'ico',
                        'format' => 'image',
                    ],
//                    [
//                        'attribute' => 'name',
//                        'label' => 'Название группы',
//                    ],
//                    [
//                        'attribute' => 'members_count',
//                        'label' => 'Количество участников',
//                    ],
                    [
                        'attribute' => 'created',
                        'label' => 'Дата добавления',
//                        'format' => ['date', 'php:d/m/Y']
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}',
                        'urlCreator' => function ($action, $model, $key, $index) {
                            return [$action = 'delete_account', 'account_id' => $model->account_id];
                        },
                    ],
                ],
            ]); ?>
        </div>
    <?php else: ?>
        <h2 class="alert alert-success">Список аккаунтов пуст</h2>
        <a href="<?= Yii::$app->urlManager->createUrl(['vk/add_account']) ?>" class="myBtn">
            <button class="btn btn-primary">Добавить аккаунт</button>
        </a>
    <?php endif; ?>
</div>
