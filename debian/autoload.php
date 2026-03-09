<?php
/**
 * Autoloader for Debian package context.
 *
 * This file is intended for use in the Debian package build or test environment.
 * It includes the Composer autoloader if available, or falls back to a basic PSR-4 autoloader for the Ease namespace.
 */

declare(strict_types=1);

require_once '/usr/share/php/EaseCore/autoload.php';

// PSR-4 autoloader for 'Ease' and 'Ease\\Html' namespaces in /usr/share/php/EaseHtml/
spl_autoload_register(function ($class) {
    if (str_starts_with($class, 'Ease\\Html\\')) {
        $path = __DIR__ . '/Html/' . substr(str_replace('\\', '/', $class), strlen('Ease\\Html\\')) . '.php';
        if (file_exists($path)) {
            require_once $path;
        }
    } elseif (str_starts_with($class, 'Ease\\')) {
        $path = __DIR__ . '/' . substr(str_replace('\\', '/', $class), strlen('Ease\\')) . '.php';
        if (file_exists($path)) {
            require_once $path;
        }
    }
});
