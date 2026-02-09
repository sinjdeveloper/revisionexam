<?php

use app\controllers\ApiExampleController;
use app\controllers\LoginController;
use app\controllers\DiscussionController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function(Router $router) use ($app) {

	$router->get('/', function() use ($app) {
		$app->render('index');
	});

	// Login routes
	$router->get('/login', [ LoginController::class, 'showLogin' ]);

	$router->get('/hello-world/@name', function($name) {
		echo '<h1>Hello world! Oh hey '.$name.'!</h1>';
	});

	// Pages principales
	// Messages/Discussions route
	$router->get('/messages', [ DiscussionController::class, 'showDiscussions' ]);

	$router->get('/analytics', function() use ($app) {
		$app->render('analytics');
	});

	$router->get('/calendar', function() use ($app) {
		$app->render('calendar');
	});

	$router->get('/elements', function() use ($app) {
		$app->render('elements');
	});

	$router->get('/files', function() use ($app) {
		$app->render('files');
	});

	$router->get('/forms', function() use ($app) {
		$app->render('forms');
	});

	$router->get('/help', function() use ($app) {
		$app->render('help');
	});

	$router->get('/messages', function() use ($app) {
		$app->render('messages');
	});

	$router->get('/orders', function() use ($app) {
		$app->render('orders');
	});

	$router->get('/products', function() use ($app) {
		$app->render('products');
	});

	$router->get('/reports', function() use ($app) {
		$app->render('reports');
	});

	$router->get('/security', function() use ($app) {
		$app->render('security');
	});

	$router->get('/settings', function() use ($app) {
		$app->render('settings');
	});

	$router->get('/users', function() use ($app) {
		$app->render('users');
	});

	// Éléments individuels
	$router->get('/elements/alerts', function() use ($app) {
		$app->render('elements-alerts');
	});

	$router->get('/elements/badges', function() use ($app) {
		$app->render('elements-badges');
	});

	$router->get('/elements/buttons', function() use ($app) {
		$app->render('elements-buttons');
	});

	$router->get('/elements/cards', function() use ($app) {
		$app->render('elements-cards');
	});

	$router->get('/elements/forms', function() use ($app) {
		$app->render('elements-forms');
	});

	$router->get('/elements/modals', function() use ($app) {
		$app->render('elements-modals');
	});

	$router->get('/elements/tables', function() use ($app) {
		$app->render('elements-tables');
	});

	$router->group('/api', function() use ($router) {
		$router->get('/users', [ ApiExampleController::class, 'getUsers' ]);
		$router->get('/users/@id:[0-9]', [ ApiExampleController::class, 'getUser' ]);
		$router->post('/users/@id:[0-9]', [ ApiExampleController::class, 'updateUser' ]);

		// Login API routes
		$router->post('/login', [ LoginController::class, 'login' ]);
		$router->post('/register', [ LoginController::class, 'register' ]);
		$router->post('/logout', [ LoginController::class, 'logout' ]);
		$router->get('/user', [ LoginController::class, 'getCurrentUser' ]);

		// Discussion API routes
		$router->get('/discussions', [ DiscussionController::class, 'getDiscussions' ]);
		$router->post('/discussions/start', [ DiscussionController::class, 'startNewConversation' ]);
		$router->get('/discussions/available-users', [ DiscussionController::class, 'getAvailableUsers' ]);
	});
	
}, [ SecurityHeadersMiddleware::class ]);