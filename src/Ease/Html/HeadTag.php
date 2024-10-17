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
 * HTML webPage head class.
 */
class HeadTag extends PairTag
{
    /**
     * Javascripts to render in page.
     */
    public array $javaScripts = [];

    /**
     * Css definitions.
     *
     * @var array of strings
     */
    public array $cascadeStyles = [];

    /**
     * Content Charset.
     */
    public string $charSet = 'utf-8';

    /**
     * Html HEAD tag with basic contents and skin support.
     *
     * @param mixed $content inserted content
     */
    public function __construct($content = null)
    {
        parent::__construct('head', null, $content);
        $this->addItem('<meta http-equiv="Content-Type" content="text/html; charset='.$this->charSet.'" />');
    }

    /**
     * Change name directly to head.
     *
     * @param string $objectName object name
     *
     * @return string final object name
     */
    public function setObjectName($objectName = null)
    {
        return parent::setObjectName('head');
    }

    /**
     * Render a script block.
     *
     * @param string $javaScript inserted script
     *
     * @return string
     */
    public static function jsEnclosure($javaScript)
    {
        return <<<'EOD'

<script>
// <![CDATA[

EOD.$javaScript.<<<'EOD'

// ]]>
</script>

EOD;
    }

    /**
     * Handle page title.
     */
    public function finalize(): void
    {
        $this->addItem('<title>'.\Ease\WebPage::singleton()->getPageTitle().'</title>');
        parent::finalize();
    }

    /**
     * @param string $divider use '' for optimized output
     *
     * @return string
     */
    public static function getScriptsRendered(
        array $scriptsArray,
        $divider = "\n"
    ) {
        $scriptsRendered = '';
        ksort($scriptsArray, \SORT_NUMERIC);
        $scriptsInline = [];
        $scriptsIncluded = [];
        $ODRStack = [];

        foreach ($scriptsArray as $script) {
            $scriptType = $script[0];
            $scriptBody = substr($script, 1);

            switch ($scriptType) {
                case '#':
                    $scriptsIncluded[] = '<script src="'.$scriptBody.'"></script>';

                    break;
                case '@':
                    $scriptsInline[] = $scriptBody;

                    break;
                case '$':
                    $ODRStack[] = $scriptBody;

                    break;
            }
        }

        if (!empty($scriptsIncluded)) {
            $scriptsRendered .= $divider.implode($divider, $scriptsIncluded);
        }

        if (!empty($scriptsInline)) {
            $scriptsRendered .= $divider.self::jsEnclosure(implode(
                $divider,
                $scriptsInline,
            ));
        }

        if (!empty($ODRStack)) {
            $scriptsRendered .= $divider.
                    self::jsEnclosure(
                        '$(document).ready(function () { '.implode(
                            $divider,
                            $ODRStack,
                        ).' });',
                    );
        }

        return $scriptsRendered;
    }

    /**
     * Get included and inline Syles Fragment rendered.
     *
     * @param string $media
     * @param string $divider use '' for optimized output
     *
     * @return string
     */
    public static function getStylesRendered(
        array $stylesArray,
        $media = 'screen',
        $divider = "\n"
    ) {
        $cascadeStyles = [];
        $cascadeStylesIncludes = [];

        foreach ($stylesArray as $styleRes => $style) {
            if ($styleRes === $style) {
                $cascadeStylesIncludes[] = '<link href="'.$style.'" rel="stylesheet" type="text/css" media="'.$media.'" />';
            } else {
                $cascadeStyles[] = $style;
            }
        }

        return empty($stylesArray) ? '' : implode($divider, $cascadeStylesIncludes).$divider.'<style>'.implode(
            $divider,
            $cascadeStyles,
        ).'</style>';
    }

    /**
     * Renders the header of the HTML page.
     */
    public function draw(): void
    {
        $this->addItem(self::getStylesRendered(\Ease\WebPage::singleton()->cascadeStyles));

        parent::draw();
        $this->drawStatus = true;
    }
}
