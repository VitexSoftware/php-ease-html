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

namespace Ease;

use Ease\Html\BodyTag;
use Ease\Html\HeadTag;
use Ease\Html\HtmlTag;

/**
 * Common Web Page class.
 *
 * @author Vítězslav Dvořák <vitex@hippy.cz>
 */
class WebPage extends Document
{
    /**
     * Where to look for jQuery script.
     *
     * @var string path or URL
     */
    public string $jqueryJavaScript = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js';

    /**
     * JavaScripts to be in page.
     */
    public array $javaScripts = [];

    /**
     * CSS fields to render.
     */
    public array $cascadeStyles = [];

    /**
     * Page title.
     */
    public string $pageTitle = '';

    /**
     * Page head.
     */
    public HeadTag $head;

    /**
     * The object of the page body itself.
     */
    public BodyTag $body;

    /**
     * Do not connect to the DB.
     *
     * @var bool|string
     */
    public string $myTable = '';

    /**
     * Default JavaScripts location in Debian.
     */
    public string $jsPrefix = '/javascript/';

    /**
     * Default CSS location in Debian.
     */
    public string $cssPrefix = '/javascript/';

    /**
     * Saves object instance (singleton...).
     */
    private static $instance;

    /**
     * Content to place inside of body.
     */
    public function __construct(string $pageTitle = '', array $toBody = [])
    {
        $this->setPageTitle($pageTitle);
        parent::__construct();
        parent::addItem('<!DOCTYPE html>');
        $html = parent::addItem(new HtmlTag());
        $this->head = $html->addItem(new HeadTag());
        $this->body = $html->addItem(new BodyTag($toBody));
        $this->javaScripts = &$this->head->javaScripts;
        $this->cascadeStyles = &$this->head->cascadeStyles;
        self::singleton($this);
    }

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * Set ID for page body.
     *
     * @param null|mixed $tagID
     *
     * @return string
     */
    public function setTagID($tagID = null)
    {
        return $this->body->setTagID($tagID);
    }

    /**
     * Get ID for page body.
     *
     * @return null|string Page BODY ID
     */
    public function getTagID()
    {
        return $this->body->getTagID();
    }

    /**
     * Get body Contentets.
     *
     * @return mixed
     */
    public function getContents()
    {
        return $this->body->getContents();
    }

    /**
     * Add item into page body.
     *
     * @param mixed  $item         inserted item
     * @param string $pageItemName Under this name, the object is inserted into the tree
     *
     * @return Document poiner to object well included
     */
    public function &addItem($item, $pageItemName = null)
    {
        $added = $this->body->addItem($item, $pageItemName);

        return $added;
    }

    /**
     * Includes Javascript into the Page.
     *
     * @param string $javaScriptFile javascript file
     * @param string $position       final position: '+','-','0','--',...
     *
     * @return string
     */
    public function includeJavaScript($javaScriptFile, $position = null)
    {
        return $this->addToScriptsStack('#'.$javaScriptFile, $position);
    }

    /**
     * Inserts JavaScript into the Page.
     *
     * @param string $javaScript      JS code
     * @param string $position        final position: '+','-','0','--',...
     * @param bool   $inDocumentReady paste into a DocumentReady block ?
     *
     * @return int
     */
    public function addJavaScript(
        $javaScript,
        $position = 0,
        $inDocumentReady = true
    ) {
        return $this->addToScriptsStack(($inDocumentReady ? '$' : '@').$javaScript, $position);
    }

    /**
     * Inserts javascript into the bin of the page script.
     *
     * @param string $code     JS code
     * @param string $position final position: '+','-','0','--',...
     *
     * @return int
     */
    public function addToScriptsStack($code, $position = 0)
    {
        $javaScripts = &self::singleton()->javaScripts;

        if ($position) {  // Force Position
            if (isset($javaScripts[$position])) { // Already taken
                if ($javaScripts[$position] === $code) {
                    return $position;
                }

                $scriptFound = array_search($code, $javaScripts, true);

                if ($scriptFound) {
                    unset($javaScripts[$scriptFound]);
                }

                $backup = \array_slice($javaScripts, $position);
                $javaScripts[$position] = $code;
                $nextFreeID = $position + 1;

                foreach ($backup as $code) {
                    $javaScripts[$nextFreeID++] = $code;
                }

                return $nextFreeID - 1;
            }

            // position still free
            $javaScripts[] = $code;

            $position = key($javaScripts);
        } else {
            $scriptFound = array_search($code, $javaScripts, true);

            if ($scriptFound === false) {
                $javaScripts[] = $code;

                $position = key($javaScripts);
            } else {
                $position = $scriptFound;
            }
        }

        return $position;
    }

    /**
     * Add another CSS definition to stack.
     *
     * @param string $css definice CSS pravidla
     *
     * @return bool
     */
    public function addCSS($css)
    {
        if (\is_array($css)) {
            $css = key($css).'{'.current($css).'}';
        }

        $this->cascadeStyles[md5($css)] = $css;

        return true;
    }

    /**
     * Inserts a link to the CSS definition into the page.
     *
     * @param string $cssFile  file CSS url
     * @param bool   $fwPrefix Add framework path? (usually /Ease/)
     * @param string $media    screen|printer|braile etc
     *
     * @return bool success
     */
    public function includeCss($cssFile, $fwPrefix = false, $media = 'screen')
    {
        if ($fwPrefix) {
            $this->cascadeStyles[$this->cssPrefix.$cssFile] = $this->cssPrefix.$cssFile;
        } else {
            $this->cascadeStyles[$cssFile] = $cssFile;
        }

        return true;
    }

    /**
     * Use this to show status messages on page.
     *
     * @param array $properties Div properties
     *
     * @return \Ease\Html\DivTag
     */
    public function getStatusMessagesBlock($properties = [])
    {
        $htmlFargment = new Html\DivTag(null, $properties);

        foreach (\Ease\Shared::logger()->getMessages() as $message) {
            $htmlFargment->addItem(new Html\DivTag(
                \Ease\Logger\Message::getTypeUnicodeSymbol($message->type).'&nbsp;'.$message->body,
                ['style' => Logger\Regent::singleton()->logStyles[$message->type], 'data-caller' => \is_object($message->caller) ? \get_class($message->caller) : $message->caller],
            ));
        }

        return $htmlFargment;
    }

    /**
     * Renders the contents of the object.
     *
     * @return string Empty string
     */
    public function draw(): void
    {
        $this->finalizeRegistred();
        $this->drawAllContents();
        $this->drawStatus = true;
    }

    /**
     * Finalizes all registered objects.
     */
    public function finalizeRegistred(): void
    {
        do {
            foreach (self::$allItems as $PartID => $part) {
                if (\is_object($part)) {
                    $part->finalize();
                }

                unset(self::$allItems[$PartID]);
            }
        } while (!empty(self::$allItems));
    }

    /**
     * Sets the title of the web page.
     *
     * @param string $pageTitle title
     */
    public function setPageTitle($pageTitle): void
    {
        $this->pageTitle = $pageTitle;
    }

    /**
     * Return number of enclosed items in current page body or given object.
     *
     * @return int number of parts enclosed
     */
    public function getItemsCount()
    {
        return $this->body->getItemsCount();
    }

    /**
     * Returns the first inserted item.
     */
    public function getFirstPart()
    {
        return $this->isEmpty() ? null : reset($this->body->pageParts);
    }

    /**
     * Is body element empty ?
     */
    public function isEmpty(): bool
    {
        return empty($this->body->pageParts);
    }

    /**
     * Inserts as the first element in the object.
     *
     * @param mixed  $pageItem     value or EaseObject with draw () method
     * @param string $pageItemName under this name, the object is inserted into the tree
     *
     * @return mixed A reference to the embedded object
     */
    public function &addAsFirst($pageItem, $pageItemName = null)
    {
        return $this->body->addAsFirst($pageItem, $pageItemName);
    }

    /**
     * Returns a link to the last inserted item.
     *
     * @return Embedable|string
     */
    public function &lastItem()
    {
        $lastPart = empty($this->body->pageParts) ? null : end($this->body->pageParts);

        return $lastPart;
    }

    /**
     * Adds an item to the last inserted item.
     *
     * @param object $pageItem value or EaseObject with draw () method
     *
     * @return null|Container success
     */
    public function addToLastItem($pageItem)
    {
        return $this->isEmpty() ? null : end($this->body->pageParts)->addItem($pageItem);
    }

    /**
     * Empties webpage contents.
     */
    public function emptyContents(): void
    {
        $this->body->emptyContents();
    }

    /**
     * @param null|mixed $webPage
     *
     * @return WebPage
     */
    public static function singleton($webPage = null)
    {
        if (!isset(self::$instance)) {
            self::$instance = \is_object($webPage) ? $webPage : new self();
            \Ease\Document::singleton()->registerItem(self::$instance);
        }

        return self::$instance;
    }

    /**
     * Clears Cache of JavaScripts to be rendered into page.
     */
    public static function clearJavaScriptsCache(): bool
    {
        self::singleton()->javaScripts = [];

        return empty(self::singleton()->javaScripts);
    }

    /**
     * Clears Cache of JavaScripts to be rendered into page.
     */
    public static function clearCascadeStylesCache(): bool
    {
        self::singleton()->cascadeStyles = [];

        return empty(self::singleton()->cascadeStyles);
    }
}
