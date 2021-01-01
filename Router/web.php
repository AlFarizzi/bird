<?php
use core\Router;
use app\controllers\HomeController;
Router::get("/dashboard", [HomeController::class, 'index']);
Router::get("/settings", [HomeController::class, 'setting']);
Router::post('/post', [HomeController::class, 'posting']);
Router::exec();