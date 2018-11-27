<li style="padding-left: 0">
    <a href="<?= \yii\helpers\Url::to(['categories/view', 'id' => $category['id']]) ?>">
        <?= $category['ico_name'] ?>
        <?= $category['title'] ?>
        <?php if (isset($category['childs'])): ?>
        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
    </a>
    <ul>
        <?php foreach ($category['childs'] as $child): ?>
            <li>
                <a href="<?= \yii\helpers\Url::to(['categories/view', 'id' => $child['id']]) ?>">
                    <?= $child['title'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</li>
