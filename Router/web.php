<?php
use app\core\Router;
use app\controllers\HomeController;
Router::get("/dashboard", [HomeController::class, 'index']);
Router::post('/post',[HomeController::class, 'post']);
Router::exec();