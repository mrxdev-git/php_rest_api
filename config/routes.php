<?php

use \DataEx\Routing\Router;
use \DataEx\Controller\CategoriesController;
use \DataEx\Controller\ProductsController;
use \DataEx\Controller\FeaturesController;

Router::get('/categories', [
	   CategoriesController::class
]);

Router::get('/products', [
	   ProductsController::class
]);

Router::get('/features', [
	   FeaturesController::class
]);



