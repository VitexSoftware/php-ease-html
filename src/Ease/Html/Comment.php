<?php
declare (strict_types=1);

namespace Ease\Html;

/**
 * Description of Comment
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class Comment extends Tag
{
    /**
     * Typ tagu - např A či STRONG.
     *
     * @var string
     */
    public $tagType = '!--';

    /**
     * Koncové lomítko pro xhtml.
     *
     * @var string
     */
    public $trail = ' --';

    /**
     * 
     * @param string $comment
     */
    public function __construct($comment)
    {
        parent::__construct('!--', [$comment]);
    }

}
