<?php
declare(strict_types=1);
namespace core;

class Router
{
    private string $pageUriPath;
    private ?string $pagePath = null;
    private ?string $layoutPath = null;
    private array $params = [];

    public function __construct(string $request_uri)
    {
        $this->parseUri($request_uri);
        $this->resolveRoute();
    }

    public function getPagePath(): ?string
    {
        return $this->pagePath;
    }

    public function getLayoutPath(): ?string
    {
        return $this->layoutPath;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getParam(string $key, $default = null)
    {
        return $this->params[$key] ?? $default;
    }

    public function redirect(string $path): void
    {
        header("Location: " . APP["url"] . "/" . $path);
        exit();
    }

    private function parseUri(string $request_uri): void
    {
        $this->pageUriPath = trim(parse_url($request_uri, PHP_URL_PATH), "/");

        $rootName = basename(PATHS["root"]);
        if (str_starts_with($this->pageUriPath, $rootName)) {
            $this->pageUriPath = substr($this->pageUriPath, strlen($rootName) + 1);
        }

        $query = parse_url($request_uri, PHP_URL_QUERY);
        if ($query) {
            parse_str($query, $this->params);
        }
    }

    private function resolveRoute(): void
    {
        if (!$this->dfs(PATHS["pages"]) && !isset($this->layoutPath)) {
            $this->redirect("404");
        }
    }

    private function dfs(string $currentFolderPath, ?string $currentLayoutPath = null): bool
    {
        // Check for layout in the current folder only once per visit
        if (file_exists($currentFolderPath . "/layout.php")) {
            $currentLayoutPath = $currentFolderPath . "/layout.php";
        }

        $fullPath = PATHS["pages"];
        if ($this->pageUriPath !== "") {
            $fullPath .= "/" . $this->pageUriPath;
        }

        if ($this->stripGroupsFromPath($currentFolderPath) === $fullPath) {
            if (file_exists($currentFolderPath . "/page.php")) {
                $this->pagePath = $currentFolderPath . "/page.php";

                if ($currentLayoutPath) {
                    $this->layoutPath = $currentLayoutPath;
                }
                return true;
            }
        }

        $folderPaths = glob($currentFolderPath . "/*", GLOB_ONLYDIR);
        if ($folderPaths === false) {
            return false;
        }

        foreach ($folderPaths as $folderPath) {
            if ($this->dfs($folderPath, $currentLayoutPath)) {
                return true;
            }
        }

        return false;
    }

    private function stripGroupsFromPath(string $currentFolderPath): string
    {
        return preg_replace("/\([^)]*\)\//", "", $currentFolderPath);
    }
}
