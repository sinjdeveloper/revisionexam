<?php

use app\controllers\ApiExampleController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
use app\models\ProductModel;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function (Router $router) use ($app) {

	// Helper function to render with nonce
	$render = function($view) use ($app) {
		$nonce = $app->get('csp_nonce');
		$app->render($view, ['nonce' => $nonce]);
	};

	// Login index
	$router->get('/', function () use ($app, $render) {
		$render('welcome');
	});









	// Template routes group
	$router->group('/TEMPLATE', function (Router $router) use ($app, $render) {

		// Page d'accueil template
		$router->get('/', function () use ($app, $render) {
			$render('TEMPLATE/index');
		});

		// Dashboard
		$router->get('/dashboard', function () use ($app, $render) {
			$render('TEMPLATE/index');
		});

		// Analytics
		$router->get('/analytics', function () use ($app, $render) {
			$render('TEMPLATE/analytics');
		});

		// Calendar
		$router->get('/calendar', function () use ($app, $render) {
			$render('TEMPLATE/calendar');
		});

		// Elements - Page principale
		$router->get('/elements', function () use ($app, $render) {
			$render('TEMPLATE/elements');
		});

		// Elements - Alerts
		$router->get('/elements/alerts', function () use ($app, $render) {
			$render('TEMPLATE/elements-alerts');
		});

		// Elements - Badges
		$router->get('/elements/badges', function () use ($app, $render) {
			$render('TEMPLATE/elements-badges');
		});

		// Elements - Buttons
		$router->get('/elements/buttons', function () use ($app, $render) {
			$render('TEMPLATE/elements-buttons');
		});

		// Elements - Cards
		$router->get('/elements/cards', function () use ($app, $render) {
			$render('TEMPLATE/elements-cards');
		});

		// Elements - Forms
		$router->get('/elements/forms', function () use ($app, $render) {
			$render('TEMPLATE/elements-forms');
		});

		// Elements - Modals
		$router->get('/elements/modals', function () use ($app, $render) {
			$render('TEMPLATE/elements-modals');
		});

		// Elements - Tables
		$router->get('/elements/tables', function () use ($app, $render) {
			$render('TEMPLATE/elements-tables');
		});

		// Files
		$router->get('/files', function () use ($app, $render) {
			$render('TEMPLATE/files');
		});

		// Forms
		$router->get('/forms', function () use ($app, $render) {
			$render('TEMPLATE/forms');
		});

		// Help
		$router->get('/help', function () use ($app, $render) {
			$render('TEMPLATE/help');
		});

		// Messages
		$router->get('/messages', function () use ($app, $render) {
			$render('TEMPLATE/messages');
		});

		// Orders
		$router->get('/orders', function () use ($app, $render) {
			$render('TEMPLATE/orders');
		});

		// Products
		$router->get('/products', function () use ($app, $render) {
			$render('TEMPLATE/products');
		});

		// Reports
		$router->get('/reports', function () use ($app, $render) {
			$render('TEMPLATE/reports');
		});

		// Security
		$router->get('/security', function () use ($app, $render) {
			$render('TEMPLATE/security');
		});

		// Settings
		$router->get('/settings', function () use ($app, $render) {
			$render('TEMPLATE/settings');
		});

		// Users
		$router->get('/users', function () use ($app, $render) {
			$render('TEMPLATE/users');
		});

	});

	// $router->group('/api', function () use ($router) {
	// 	$router->get('/users', [ApiExampleController::class, 'getUsers']);
	// 	$router->get('/users/@id:[0-9]', [ApiExampleController::class, 'getUser']);
	// 	$router->post('/users/@id:[0-9]', [ApiExampleController::class, 'updateUser']);
	// });

}, [SecurityHeadersMiddleware::class]);
