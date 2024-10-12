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

namespace Ease\Html;

/**
 *  @author Vítězslav Dvořák <info@vitexsoftware.cz>, Jana Viktorie Borbina <jana@borbina.com>
 *
 * Body class of HTML page.
 */
class BodyTag extends PairTag
{
    /**
     * The page body is always avalible in the app as
     * WebPage::singleton()->body.
     *
     * @param mixed $content    inserted content
     * @param array $properties body tag properties
     */
    public function __construct($content = null, $properties = [])
    {
        parent::__construct('body', $properties, $content);
    }

    /**
     * Sets the object name to "body".
     *
     * @param string $objectName object name
     */
    public function setObjectName($objectName = null)
    {
        return parent::setObjectName('body');
    }

    /**
     * Renders the head of the HTML page.
     */
    public function draw(): void
    {
        $this->addItem(HeadTag::getScriptsRendered(\Ease\WebPage::singleton()->javaScripts));
        parent::draw();
        $this->drawStatus = true;
    }
}
