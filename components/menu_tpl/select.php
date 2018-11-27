<div class="col-lg-2">
    <div class="btn-group">
        <?php if (isset($category['childs'])): ?>
            <button type="button" class="btn btn-primary btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                <a id="title" href="<?= \yii\helpers\Url::to(['categories/settings', 'id' => $category['id']]) ?>">
                    <?= $category['ico_name'] ?>
                    <?= $category['title'] ?>
            </button>
            <div class="dropdown-menu">
                <?php foreach ($category['childs'] as $child): ?>
                    <a class="dropdown-item"
                       href="<?= \yii\helpers\Url::to(['categories/settings', 'id' => $child['id']]) ?>">
                        <?= $child['title'] ?><br>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <button type="button" id="select" class="btn btn-primary btn-block" aria-haspopup="true" aria-expanded="false">
                <a id="title" href="<?= \yii\helpers\Url::to(['categories/settings', 'id' => $category['id']]) ?>">
                    <?= $category['ico_name'] ?>
                    <?= $category['title'] ?>
                </a>
            </button>
        <?php endif; ?>
    </div>
</div>
