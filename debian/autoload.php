<?php
/**
 * Debian autoloader for php-vitexsoftware-ease-html
 *
 * @license MIT
 */

require_once '/usr/share/php/EaseCore/autoload.php';

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
