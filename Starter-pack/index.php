<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//include all your model files here
require 'Model/Article.php';
//include all your controllers here
require 'Controller/HomepageController.php';
require 'Controller/ArticleController.php';

// Get the current page to load
$page = $_GET['page'] ?? null;

// Load the controller
switch ($page) {
    case 'articles-index':
        (new ArticleController())->index();
        break;
    case 'articles-show':
        (new ArticleController())->show();
        break;
    case 'articles-create':
        (new ArticleController())->create();
        break;
    case 'articles-edit':
        (new ArticleController())->edit();
        break;
    case 'articles-delete':
        (new ArticleController())->delete();
        break;
    case 'home':
    default:
        (new HomepageController())->index();
        break;
}