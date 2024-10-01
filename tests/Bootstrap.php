<?php

declare(strict_types=1);

/**
 * This file is part of the EaseHtml package
 *
 * https://github.com/VitexSoftware/php-ease-html
 *
 * (c) Vítězslav Dvořák <http://vitexsoftware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/../vendor/autoload.php';

if ((\PHP_SAPI !== 'cli') && (session_status() === 'PHP_SESSION_NONE')) {
    session_start();
} else {
    $_SESSION = [];
}

\define('EASE_APPNAME', 'EaseHtmlUnitTest');
\define('EASE_LOGGER', 'syslog');

\Ease\Locale::singleton('cs_CZ');
// \Ease\Shared::webPage(new \Ease\WebPage());
\Ease\Shared::user(\Ease\User::singleton(null, '\Ease\User'));
