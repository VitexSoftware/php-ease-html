<?php
/**
 * Common webpage class
 *
 * @author     Vítězslav Dvořák <vitex@hippy.cz>
 * @copyright  2009-2019 Vitex@hippy.cz (G)
 */

namespace Ease;

use Ease\Html\BodyTag;
use Ease\Html\HeadTag;
use Ease\Html\HtmlTag;

/**
 * Common Web Page class
 *
 * @author Vítězslav Dvořák <vitex@hippy.cz>
 */
class WebPage extends Document
{
    /**
     * Saves obejct instace (singleton...).
     */
    private static $instance = null;

    /**
     * Where to look for jquery script
     * @var string path or url 
     */
    public $jqueryJavaScript = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js';

    /**
     * JavaScripts to be in page
     *
     * @var array
     */
    public $javaScripts = null;

    /**
     * Pole CSS k vykreslení.
     *
     * @var array
     */
    public $cascadeStyles = null;

    /**
     * Nadpis stránky.
     *
     * @var string
     */
    public $pageTitle = null;

    /**
     * head stránky.
     *
     * @var HeadTag
     */
    public $head = null;

    /**
     * Objekt samotného těla stránky.
     *
     * @var BodyTag
     */
    public $body = null;

    /**
     * Nepřipojovat se DB.
     *
     * @var string|bool
     */
    public $myTable = false;

    /**
     * Výchozí umístění javascriptů v Debianu.
     *
     * @var string
     */
    public $jsPrefix = '/javascript/';

    /**
     * Default CSS locaton on debian.
     *
     * @var string
     */
    public $cssPrefix = '/javascript/';

    /**
     * Content to place inside of body
     * 
     * @param $pageTitle string 
     * @param $toBody    mixed
     */
    public function __construct($pageTitle = null, $toBody = [])
    {
        $this->setPageTitle($pageTitle);

        parent::__construct();
        parent::addItem('<!DOCTYPE html>');
        $html                = parent::addItem(new HtmlTag());
        $this->head          = $html->addItem(new HeadTag());
        $this->body          = $html->addItem(new BodyTag($toBody));
        $this->javaScripts   = &$this->head->javaScripts;
        $this->cascadeStyles = &$this->head->cascadeStyles;
        self::singleton($this);
    }

    /**
     * 
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * Set ID for page body
     *
     * @return string
     */
    public function setTagID($tagID = null)
    {
        return $this->body->setTagID($tagID);
    }

    /**
     * Get ID for page body
     * 
     * @return string|null Page BODY ID
     */
    public function getTagID()
    {
        return $this->body->getTagID();
    }

    /**
     * Get body Contentets
     * 
     * @return mixed
     */
    public function getContents()
    {
        return $this->body->getContents();
    }

    /**
     * Add item into page body
     *
     * @param mixed  $item         vkládaná položka
     * @param string $pageItemName Pod tímto jménem je objekt vkládán do stromu
     *
     * @return Document poiner to object well included
     */
    public function &addItem($item, $pageItemName = null)
    {
        $added = $this->body->addItem($item, $pageItemName);

        return $added;
    }

    /**
     * Includuje Javascript do stránky.
     *
     * @param string $javaScriptFile soubor s javascriptem
     * @param string $position       končná pozice: '+','-','0','--',...
     *
     * @return string
     */
    public function includeJavaScript($javaScriptFile, $position = null)
    {
        return $this->addToScriptsStack('#'.$javaScriptFile, $position);
    }

    /**
     * Vloží javascript do stránky.
     *
     * @param string $javaScript      JS code
     * @param string $position        končná pozice: '+','-','0','--',...
     * @param bool   $inDocumentReady vložit do DocumentReady bloku ?
     *
     * @return int
     */
    public function addJavaScript($javaScript, $position = null,
                                  $inDocumentReady = true)
    {
        return $this->addToScriptsStack(($inDocumentReady ? '$' : '@').$javaScript,
                $position);
    }

    /**
     * Vloží javascript do zasobniku skriptu stránky.
     *
     * @param string $code     JS code
     * @param string $position končná pozice: '+','-','0','--',...
     *
     * @return int
     */
    public function addToScriptsStack($code, $position = 0)
    {
        $javaScripts = & \Ease\WebPage::singleton()->javaScripts;
        if ($position == 0) {
            if (!empty($javaScripts)) {
                $scriptFound = array_search($code, $javaScripts);
                if (!$scriptFound && ($javaScripts[0] != $code)) {
                    $javaScripts[] = $code;

                    return key($javaScripts);
                } else {
                    return $scriptFound;
                }
            } else {
                $javaScripts[] = $code;
            }
        } else { //Pozice urcena
            if (isset($javaScripts[$position])) { //Uz je obsazeno
                if ($javaScripts[$position] == $code) {
                    return $position;
                }

                $scriptFound = array_search($code, $javaScripts);
                if ($scriptFound) {
                    unset($javaScripts[$scriptFound]);
                }

                $backup                 = array_slice($javaScripts, $position);
                $javaScripts[$position] = $code;
                $nextFreeID             = $position + 1;
                foreach ($backup as $code) {
                    $javaScripts[$nextFreeID++] = $code;
                }

                return $nextFreeID - 1;
            } else { //Jeste je pozice volna
                $javaScripts[] = $code;

                return key($javaScripts);
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
        if (is_array($css)) {
            $css = key($css).'{'.current($css).'}';
        }
        $this->cascadeStyles[md5($css)] = $css;
        return true;
    }

    /**
     * Vloží do stránky odkaz na CSS definici.
     *
     * @param string $cssFile  url CSS souboru
     * @param bool   $fwPrefix Přidat cestu frameworku ? (obvykle /Ease/)
     * @param string $media    screen|printer|braile a podobně
     *
     * @return boolean success
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
     * Use this to show status messages on page
     *
     * @return \Ease\Html\DivTag
     */
    public function getStatusMessagesBlock()
    {
        $htmlFargment = new Html\DivTag();

        foreach (\Ease\Shared::singleton()->getStatusMessages() as $quee => $messages) {
            foreach ($messages as $message) {
                $htmlFargment->addItem(new Html\DivTag($message,['style'=> Logger\Regent::singleton()->logStyles[$quee] ]));
            }
        }
        return $htmlFargment;
    }

    /**
     * Provede vykreslení obsahu objektu.
     */
    public function draw()
    {
        $this->finalizeRegistred();
        $this->drawAllContents();
    }

    /**
     * Provede finalizaci všech registrovaných objektů.
     */
    public function finalizeRegistred()
    {
        do {
            foreach (self::$allItems as $PartID => $part) {
                if (is_object($part)) {
                    $part->finalize();
                }
                unset(self::$allItems[$PartID]);
            }
        } while (!empty(self::$allItems));
    }

    /**
     * Nastaví titul webové stánky.
     *
     * @param string $pageTitle titulek
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }

    /**
     * Vrací počet vložených položek.
     * Obtain number of enclosed items in current page body or given object.
     *
     * @return int nuber of parts enclosed
     */
    public function getItemsCount()
    {
        return $this->body->getItemsCount();
    }

    /**
     * Vrací první vloženou položku.
     */
    public function getFirstPart()
    {
        return $this->isEmpty() ? null : reset($this->body->pageParts);
    }

    /**
     * Je element prázdný ?
     * Is body element empty ?
     *
     * @return bool emptyness
     */
    public function isEmpty($element = null)
    {
        return empty($this->body->pageParts);
    }

    
    /**
     * Vloží jako první element do objektu.
     *
     * @param mixed  $pageItem     hodnota nebo EaseObjekt s metodou draw()
     * @param string $pageItemName Pod tímto jménem je objekt vkládán do stromu
     *
     * @return mixed Odkaz na vložený objekt
     */
    public function &addAsFirst($pageItem, $pageItemName = null)
    {
       return $this->body->addAsFirst($pageItem, $pageItemName);
    }
    
    /**
     * Vrací odkaz na poslední vloženou položku.
     *
     * @return Embedable|string
     */
    public function &lastItem()
    {
        $lastPart = empty($this->body->pageParts) ? null : end($this->body->pageParts);
        return $lastPart;
    }
    
    /**
     * Přidá položku do poslední vložené položky.
     *
     * @param object $pageItem hodnota nebo EaseObjekt s metodou draw()
     *
     * @return Container|null success
     */
    public function addToLastItem($pageItem)
    {
        return $this->isEmpty() ? null : end($this->body->pageParts)->addItem($pageItem);
    }

    
    /**
     * Vyprázní obsah webstránky
     * Empty webpage contents
     */
    public function emptyContents()
    {
        $this->body->emptyContents();
    }

    /**
     * @return WebPage
     */
    public static function singleton($webPage = null)
    {
        if (!isset(self::$instance)) {
            self::$instance = is_object($webPage) ? $webPage : new self();
        }
        return self::$instance;
    }
}
