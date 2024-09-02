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

$tableData = [
    'head' => ['col1' => 'col1 heading', 'col2' => 'col2 heading', 'col3' => 'col3 heading'],
    'body' => ['col1' => 'col1 body', 'col2' => 'col2 body', 'col3' => 'col3 body'],
    'foot' => ['col1' => 'col1 footer', 'col2' => 'col2 footer', 'col3' => 'col3 footer'],
];

$table = new \Ease\Html\TableTag(null, ['class' => 'table', 'id' => 'myTable']);

$table->addRowHeaderColumns($tableData['head']);
$table->addRowColumns($tableData['body']);
$table->addRowFooterColumns($tableData['foot']);

echo $table;

/**
 * Produced code:
 *
 * <table class="table", id="myTable">
 * <thead>
 * <tr>
 * <th>col1 heading</th>
 * <th>col2 heading</th>
 * <th>col3 heading</th>
 * </tr>
 * </thead>
 * <tbody>
 * <tr>
 * <td>col1 body</td>
 * <td>col2 body</td>
 * <td>col3 body</td>
 * </tr>
 * </tbody>
 * <tfoot>
 * <tr>
 * <th>col1 footer</th>
 * <th>col2 footer</th>
 * <th>col3 footer</th>
 * </tr>
 * </tfoot>
 * </table>
 */
