<?php
/**
 * Autoloader for Debian package context.
 *
 * This file is intended for use in the Debian package build or test environment.
 * It includes the Composer autoloader if available, or falls back to a basic PSR-4 autoloader for the Ease namespace.
 */

declare(strict_types=1);

require_once '/usr/share/php/Ease/autoload.php';

// PSR-4 autoloader for EaseHtml classes
spl_autoload_register(function (string $class): void {
    // Handle Ease\Html namespace
    if (strpos($class, 'Ease\\Html\\') === 0) {
        $relativeClass = substr($class, 10); // Remove 'Ease\Html\'
        $file = '/usr/share/php/EaseHtml/Html/' . str_replace('\\', '/', $relativeClass) . '.php';
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
    
    // Handle general Ease namespace (but not EaseCore classes)
    if (strpos($class, 'Ease\\') === 0 && strpos($class, 'Ease\\Html\\') !== 0) {
        $relativeClass = substr($class, 5); // Remove 'Ease\'
        $file = '/usr/share/php/EaseHtml/' . str_replace('\\', '/', $relativeClass) . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }
});

require_once '/usr/share/php/Composer/InstalledVersions.php';

(function (): void {
    $versions = [];
    foreach (\Composer\InstalledVersions::getAllRawData() as $d) {
        $versions = array_merge($versions, $d['versions'] ?? []);
    }
    $name    = defined('APP_NAME')    ? APP_NAME    : 'unknown';
    $version = defined('APP_VERSION') ? APP_VERSION : '0.0.0';
    $versions[$name] = ['pretty_version' => $version, 'version' => $version,
        'reference' => null, 'type' => 'library', 'install_path' => __DIR__,
        'aliases' => [], 'dev_requirement' => false];
    \Composer\InstalledVersions::reload([
        'root' => ['name' => $name, 'pretty_version' => $version, 'version' => $version,
            'reference' => null, 'type' => 'project', 'install_path' => __DIR__,
            'aliases' => [], 'dev' => false],
        'versions' => $versions,
    ]);
})();
