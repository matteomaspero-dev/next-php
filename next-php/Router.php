<?php

declare(strict_types=1);

class Router {
	private string $route;
	private array $queryParams = [];

	public function resolve(string $request_uri): string {
		$request_uri = $this->sanitizeUri($request_uri);

		// Separate route from query string
		$parts = explode('?', $request_uri, 2);
		$this->route = APP_PATH . $parts[0];

		// Parse query params if they exist
		if (isset($parts[1])) {
			parse_str($parts[1], $this->queryParams);
		}

		return $this->route;
	}

	public function getQueryParams(): array {
		return $this->queryParams;
	}

	public function getParam(string $key, mixed $default = null): mixed {
		return $this->queryParams[$key] ?? $default;
	}

	public function redirect(string $path): void {
		$path = '/' . ltrim($path, '/');
		$destination = APP_URL . $path;

		// Perform the redirect
		header("Location: $destination");
		exit;
	}

	private function sanitizeUri(string $uri): string {
		// Prevent directory traversal attacks
		// urldecode ensures we catch encoded dots like %2e%2e
		if (strpos(urldecode($uri), '..') !== false) {
			throw new Exception('Directory traversal detected', 400);
		}

		// Remove the base directory, if present (e.g., /myapp)
		$uri = trim($uri, '/');
		$rootName = basename(ROOT_PATH);
		if (str_starts_with($uri, $rootName)) {
			$uri = substr($uri, strlen($rootName));
		}
		return '/' . ltrim($uri, '/');
	}
}
