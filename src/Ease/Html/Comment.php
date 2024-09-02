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
 * Description of a Comment.
 */
class Comment extends Tag
{
    /**
     * Tag type - f.e. A or STRONG.
     */
    public string $tagType = '!--';

    /**
     * Trailing for xhtml.
     */
    public string $trail = ' --';

    /**
     * @param string $comment
     */
    public function __construct($comment)
    {
        parent::__construct('!--', [$comment]);
    }
}
