<?php
$modules = config('modular.modules');
$path = config('modular.path');
$baseNamespace = config('modular.base_namespace');

if ($modules) {
    foreach ($modules as $module => $subModules) {
        foreach ($subModules as $key => $subModule) {
            if (is_string($key)) {
                $subModule = $key;
            }
            $relativePath = '/' . $module . '/' . $subModule;
            $routePath = $path . $relativePath . "/Routes/web.php";
            if (file_exists($routePath)) {
                Route::namespace("Modules\\$module\\$subModule\\Http\\Controllers")->group($routePath);
            }
        }
    }
}
