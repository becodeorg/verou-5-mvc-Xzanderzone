<?php require 'View/includes/header.php' ?>

<?php var_dump($article) ?>

<section>
    <h1><?= $article->title ?></h1>
    <p><?= $article->formatPublishDate() ?></p>
    <p><?= $article->description ?></p>

    <?php
    //should be improved
    
    $id = $article->getId();
    if ($id > 1)
        $previous = $id - 1;
    if ($id < 10)
        $next = $id + 1; ?>
    <a href="?page=articles-show&id=<?= $previous ?>">Previous article</a>
    <a href="?page=articles-show&id=<?= $next ?>">Next article</a>
</section>

<?php require 'View/includes/footer.php' ?>