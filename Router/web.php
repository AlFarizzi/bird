<?php
use app\core\Router;
use app\controllers\HomeController;
Router::get("/", [HomeController::class, 'index']);
Router::exec();