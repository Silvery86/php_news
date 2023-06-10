

<?php
if (! empty($data) && is_array($data)): ?>

<?php foreach ($data as $article_item): ?>

    <h3><?= esc($article_item['title']) ?></h3>

    <div class="main">
        <?= esc($article_item['author']) ?>
    </div>
    

<?php endforeach ?>

<?php else: ?>

<h3>No News</h3>

<p>Unable to find any news for you.</p>

<?php endif ?>