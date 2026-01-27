<?php
declare(strict_types=1);

class Page {
	private string $pageUri;
	private string $pagePath;
	private string $layoutPath;

	public function __construct(string $pageUri) {
		$this->pageUri = $pageUri;
		$this->dfs(PATHS["pages"]);
		
		echo "Page Path: " . $this->pagePath . "\n";
		echo "Layout Path: " . $this->layoutPath . "\n";
	}

	private function dfs(string $currentFolderPath, ?string $currentLayoutPath = null): bool {
		if (is_file($currentFolderPath . "/layout.php")) {
			// Overwrite the current layout path if a new layout is found
			$currentLayoutPath = $currentFolderPath . "/layout.php";
		}

		if ($this->stripGroupsFromPath($currentFolderPath) == PATHS["pages"] . "/" . $this->pageUri) {
			$this->pagePath = $currentFolderPath . "/page.php";
			// Save the specific layout valid for this branch
			if ($currentLayoutPath) {
				$this->layoutPath = $currentLayoutPath;
			}

			return true;
		}
		
		$folderPaths = glob($currentFolderPath . "/*", GLOB_ONLYDIR);
		foreach ($folderPaths as $folderPath) {
			if ($this->dfs($folderPath, $currentLayoutPath)) {
				// Stop searching once the page is found
				return true;
			}
		}

		return false;
	}

	private function stripGroupsFromPath(string $currentFolderPath): string {
		return preg_replace("/\([^)]*\)\//", "", $currentFolderPath);
	}
}
