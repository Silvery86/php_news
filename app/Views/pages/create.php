<h2><?= esc($page_title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="/articles/create" method="post">
    <?= csrf_field() ?>

    <label for="author">Author</label>
    <input type="input" name="author" value="<?= set_value('author') ?>">
    <br>

    <label for="title">Title</label>
    <textarea name="title" cols="45" rows="4"><?= set_value('title') ?></textarea>
    <br>

    <label for="description">Description</label>
    <input type="input" name="description" value="<?= set_value('description') ?>">
    <br>

    <label for="url">Url</label>
    <input type="input" name="url" value="<?= set_value('url') ?>">
    <br>

    <label for="url_image">Url Image</label>
    <input type="input" name="url_image" value="<?= set_value('url_image') ?>">
    <br>

    <label for="published_date">Publish Date</label>
    <input type="date" name="published_date" value="<?= set_value('published_date') ?>">
    <br>

    <label for="content">Title</label>
    <input type="input" name="content" value="<?= set_value('content') ?>">
    <br>


    <input type="submit" name="submit" value="Create news article">
</form>