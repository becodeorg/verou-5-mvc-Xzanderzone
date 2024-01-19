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

        // Load the view
        require 'View/articles/index.php';
    }

    // Note: this function can also be used in a repository - the choice is yours
    private function getArticles()
    {
        // TODO: prepare the database connection
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
}