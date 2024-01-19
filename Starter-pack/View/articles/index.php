<?php require 'View/includes/header.php' ?>

<?php // Use any data loaded in the controller here ?>

<section>
    <h1>Articles</h1>
    <ul>
        <?php foreach ($articles as $article): ?>
            <li><?= $article->title ?> (<?= $article->formatPublishDate() ?>)</li>

            <ol><a href="?page=articles-edit&id=<?= $article->getId() ?>">edit</a>
                <a href="?page=articles-delete&id=<?= $article->getId() ?>">delete</a>
            </ol>
        <?php endforeach; ?>
    </ul>
</section>

<?php require 'View/includes/footer.php' ?>