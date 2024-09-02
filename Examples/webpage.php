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

namespace Ease\Example\HTML;

require_once __DIR__.'/../vendor/autoload.php';

$head = new \Ease\Html\HeadTag(new \Ease\Html\TitleTag('Ease WebPage'));

$body = new \Ease\Html\BodyTag(new \Ease\Html\HeaderTag(new \Ease\Html\H1Tag('Web Page')));

$body->addItem(new \Ease\Html\ArticleTag('Example'));

$body->addItem(new \Ease\Html\FooterTag(new \Ease\Html\SmallTag(new \Ease\Html\ATag('v.s.cz', 'Vitex Software'))));

$oPage = new \Ease\Html\HtmlTag([$head, $body]);

echo $oPage;
