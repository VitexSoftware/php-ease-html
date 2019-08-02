<?php

namespace Ease\Html;

/**
 * HTML top tag class.
 *
 * @author Vitex <vitex@hippy.cz>
 */
class HtmlTag extends PairTag
{
    /**
     * HTML.
     *
     * @param mixed $content vložený obsah - tělo stránky
     */
    public function __construct($content = null)
    {
        parent::__construct('html', ['lang' => \Ease\Shared::locale()->get2Code()], $content);
    }

    /**
     * Nastaví jméno objektu na "html".
     *
     * @param string $ObjectName jméno objektu
     * 
     * @return string final object name
     */
    public function setObjectName($ObjectName = null)
    {
        return parent::setObjectName('html');
    }
}
