<?php

declare(strict_types=1);
require_once '../config.php';
require_once 'DatabaseManager.php';

$databaseManager = new DatabaseManager($config['host'], $config['user'], $config['password'], $config['dbname']);
$databaseManager->connect();
class ArticleController
{
    private $table = 'articles';
    public function index()
    {
        // Load all required data
        $articles = $this->getArticles();

        require 'View/articles/index.php';
    }

    private function getArticles()
    {
        try {
            global $databaseManager;
            $query = $databaseManager->connection->query("SELECT * FROM $this->table");
            $rawArticles = $query->fetchAll(PDO::FETCH_ASSOC);
            echo var_dump($rawArticles);
            $articles = [];
            foreach ($rawArticles as $rawArticle) {
                $articles[] = new Article($rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date']);
            }

            return $articles;
        } catch (PDOException $e) {
            echo "query failed" . $e->getMessage();
        }
    }

    public function show()
    {
        // TODO: this can be used for a detail page
    }
    function create()
    {
        require 'View/articles/create.php';
        global $databaseManager;
        echo var_dump($_POST);
        if (!empty($_POST['title']) && !empty($_POST['description']))
            try {
                if (isset($_POST['Image']))
                    $databaseManager->connection->query("INSERT INTO $this->table (title,description,image)  VALUES ('$_POST[title]', '$_POST[description]', '$_POST[Image]')");
                else
                    $databaseManager->connection->query("INSERT INTO $this->table ('title','description')  VALUES ('$_POST[title]', '$_POST[description]'");
            } catch (PDOException $e) {
                echo "query failed" . $e->getMessage();

            } else
            echo "fill in the fields to add it to the collection";
    }

    function edit()
    {
        global $cardRepository;
        $edit = $cardRepository->find($_GET["name"]);
        require 'View/articles/edit.php';

        if (!empty($_POST['name']) && !empty($_POST['type']) && !empty($_POST['skill'])) {
            $cardRepository->update($edit['name'], $_POST['name'], $_POST['type'], $_POST['skill'], isset($_POST['obtained']) ? 1 : 0);
            header("Location: ?");

        } else
            echo "fields can not be left empty!";
    }
    function delete()
    {
        global $cardRepository;
        if (empty($_POST['delete'])) {
            $edit = $cardRepository->find($_GET["name"]);
            require 'View/articles/delete.php';
        } else if ($_POST['delete'] == 'confirm') {
            $_POST['delete'] = 'deleted'; //stop multiple deletes
            $cardRepository->delete($_GET['name']);
            header("Location: ?");
        }
    }
}
