<?php

use \DataEx\Routing\Router;
use \DataEx\Controller\CategoriesController;
use \DataEx\Controller\ProductsController;
use \DataEx\Controller\FiltersController;

Router::get('/categories', [
	   CategoriesController::class
]);

Router::get('/products', [
	   ProductsController::class
]);

Router::get('/filters', [
	   FiltersController::class
]);
Router::get('/filters', []);



