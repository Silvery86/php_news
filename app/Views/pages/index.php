<h2><?= esc($page_title) ?></h2>

<?php if (! empty($article) && is_array($article)): ?>

    <?php foreach ($article as $article_item): ?>

        <h3><?= esc($article_item['title']) ?></h3>

        <div class="main">
            <?= esc($article_item['author']) ?>
        </div>
        <p><a href="/articles/<?= esc($article_item['slug'], 'url') ?>">View article</a></p>

    <?php endforeach ?>

<?php else: ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>