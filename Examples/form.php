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

namespace Example\Ease\HTML;

require_once __DIR__.'/../vendor/autoload.php';

$form = new \Ease\Html\Form(['name' => 'h']);

$form->addItem(new \Ease\Html\InputTag('simple'));
$form->addItem(new \Ease\Html\InputColorTag('color'));
$form->addItem(new \Ease\Html\InputDateTag('date'));
$form->addItem(new \Ease\Html\InputDateTimeLocalTag('local'));
$form->addItem(new \Ease\Html\InputDateTimeTag('datetime'));
$form->addItem(new \Ease\Html\InputEmailTag('email'));
$form->addItem(new \Ease\Html\InputFileTag('file'));
$form->addItem(new \Ease\Html\InputHiddenTag('hidden'));
$form->addItem(new \Ease\Html\InputMonthTag('month'));
$form->addItem(new \Ease\Html\InputNumberTag('number'));
$form->addItem(new \Ease\Html\InputPasswordTag('password'));
$form->addItem(new \Ease\Html\InputRadioTag('radio'));
$form->addItem(new \Ease\Html\InputRangeTag('range'));
$form->addItem(new \Ease\Html\InputSearchTag('Search', '?', ['id' => 's']));
$form->addItem(new \Ease\Html\InputTelTag('tel'));
$form->addItem(new \Ease\Html\InputTextTag('text'));
$form->addItem(new \Ease\Html\InputTimeTag('time'));
$form->addItem(new \Ease\Html\InputUrlTag('url'));
$form->addItem(new \Ease\Html\InputWeekTag('week'));

$form->addItem(new \Ease\Html\SubmitButton('Submit'));

echo $form;
