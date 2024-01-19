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
            // echo var_dump($rawArticles);
            $articles = [];
            foreach ($rawArticles as $rawArticle) {
                $articles[] = new Article($rawArticle['id'], $rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date'], $rawArticle['image'] ?? '');
            }

            return $articles;
        } catch (PDOException $e) {
            echo "query failed" . $e->getMessage();
        }
    }

    public function show(int $id = 1)
    {
        // global $databaseManager;
        // try {
        //     $query = $databaseManager->connection->query("SELECT * FROM $this->table WHERE id = '1' LIMIT 1");
        //     $result = $query->fetch(PDO::FETCH_ASSOC);
        // } catch (PDOException $e) {
        //     echo "query failed" . $e->getMessage();
        // }

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
                    $databaseManager->connection->query("INSERT INTO $this->table (title,description)  VALUES ('$_POST[title]', '$_POST[description]'");
            } catch (PDOException $e) {
                echo "query failed" . $e->getMessage();

            } else
            echo "fill in the fields to add it to the collection";
    }

    function edit()
    {
        global $databaseManager;
        $id = (int) $_GET["id"] ?? 1;
        try {
            $query = $databaseManager->connection->query("SELECT * FROM $this->table WHERE id = '$id'");
            $edit = $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "query failed" . $e->getMessage();
        }

        require 'View/articles/edit.php';

        echo var_dump($edit) . '<br>';
        echo var_dump($_POST);
        if (!empty($_POST['title']) && !empty($_POST['description'])) {
            try {
                $prep = $databaseManager->connection->prepare("UPDATE $this->table SET title= :title ,description= :description ,image= :image  WHERE id = '$id'; ");
                $prep->bindParam(':title', $_POST["title"]);
                $prep->bindParam(':description', $_POST["description"]);
                $prep->bindParam(':image', $_POST["image"]);

                $prep->execute();
            } catch (PDOException $e) {
                echo "query failed" . $e->getMessage();
            }
            header("Location: ?page=articles-index");

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
