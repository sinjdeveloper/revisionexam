<?php
declare(strict_types=1);

namespace app\middlewares;

use flight\Engine;
use Tracy\Debugger;

class SecurityHeadersMiddleware
{
	protected Engine $app;

	public function __construct(Engine $app)
	{
		$this->app = $app;
	}
	
	public function before(array $params): void
	{
		$nonce = $this->app->get('csp_nonce');

		// development mode to execute Tracy debug bar CSS and allow eval for some libs
		$tracyCssBypass = "'nonce-{$nonce}'";
		$allowUnsafeEval = '';
		if (Debugger::$showBar === true) {
			$tracyCssBypass = ' \'unsafe-inline\'';
			// Some frontend libs (Alpine/plugins) use dynamic evaluation in dev builds.
			// Allow 'unsafe-eval' in script-src only in development/debug mode.
			$allowUnsafeEval = " 'unsafe-eval'";
		}

		// Allow Google Fonts for styles and fonts (useful for the admin template)
		$csp = "default-src 'self'; ";
		$csp .= "script-src 'self' 'nonce-{$nonce}' 'strict-dynamic'{$allowUnsafeEval}; ";
		$csp .= "style-src 'self' {$tracyCssBypass} https://fonts.googleapis.com; ";
		$csp .= "font-src 'self' https://fonts.gstatic.com data:; ";
		$csp .= "img-src 'self' data:;";
		$this->app->response()->header('X-Frame-Options', 'SAMEORIGIN');
		$this->app->response()->header("Content-Security-Policy", $csp);
		$this->app->response()->header('X-XSS-Protection', '1; mode=block');
		$this->app->response()->header('X-Content-Type-Options', 'nosniff');
		$this->app->response()->header('Referrer-Policy', 'no-referrer-when-downgrade');
		$this->app->response()->header('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
		$this->app->response()->header('Permissions-Policy', 'geolocation=()');
	}
}