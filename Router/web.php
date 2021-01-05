<?php
use  Fariz\bird\core\Router;
use  Fariz\bird\app\controllers\HomeController;
Router::get("/dashboard", [HomeController::class, 'index']);
Router::post('/post',[HomeController::class, 'post']);
Router::exec();