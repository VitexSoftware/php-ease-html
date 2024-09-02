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

use Ease\Html\ArticleTag as Article;
use Ease\Html\ATag;
use Ease\Html\DivTag;
use Ease\Html\H1Tag;
use Ease\Html\HrTag;
use Ease\Html\PTag;
use Ease\Html\SpanTag;

require_once __DIR__.'/../vendor/autoload.php';

echo new H1Tag('H1', ['style' => 'color: red']);

$a = new ATag('#');
$a->addItem(new PTag('Paragraph'));

echo $a;

echo /** @scrutinizer ignore-type */ (new ATag('#', 'LINK'))->addItem(new PTag('Paragraph'));

$ar = new Article(new HrTag());

$ar->tagName = 'Bures';

$ar->setTagProperties(['data-example' => 'CC']);

$ar->addTagClass('cssclasname');
$ar->addTagClass('cssclasname2');

$ar->addItem([new SpanTag(), ' &nbsp; ', new DivTag()]);

$ar->draw();
