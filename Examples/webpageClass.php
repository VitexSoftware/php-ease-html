<?php
/**
 * EaseFramework - HTML5 Webpage Example
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright Vitex@hippy.cz (G) 2018
 */

namespace Ease\Example\HTML;

require_once __DIR__.'/../vendor/autoload.php';

$oPage = new \Ease\WebPage('Ease WebPage');

$oPage->addJavaScript("alert('HI');",null,false);

$oPage->addItem(new \Ease\Html\HeaderTag(new \Ease\Html\H1Tag('Web Page')));

$oPage->addItem(new \Ease\Html\ArticleTag('Example'));

$oPage->addItem(new \Ease\Html\FooterTag(new \Ease\Html\SmallTag(new \Ease\Html\ATag('v.s.cz',
                'Vitex Software'))));

echo $oPage;
