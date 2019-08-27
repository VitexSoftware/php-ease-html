<?php

use Ease\Html\ATag;
use Ease\Html\H1Tag;
use Ease\Html\PTag;
use Ease\Html\ArticleTag as Article;

require_once __DIR__.'/../vendor/autoload.php';

echo new H1Tag('H1',['style'=>'color: red']);

echo (new ATag('#','LINK'))->addItem(new PTag('Paragraph'));

$ar = new Article( new \Ease\Html\HrTag() );
//$ar->setTagType('Zeman');

$ar->tagName = 'Bures';

$ar->setTagProperties(['data-example'=>'CC']);

$ar->addTagClass('cssclasname');
$ar->addTagClass('cssclasname2');

$ar->addItem([ new \Ease\Html\SpanTag(), ' &nbsp; ', new \Ease\Html\DivTag()  ]);

$ar->draw();
