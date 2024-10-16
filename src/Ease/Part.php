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

/**
 * jQuery common class.
 *
 *  @author Vítězslav Dvořák <info@vitexsoftware.cz>, Jana Viktorie Borbina <jana@borbina.com>
 */
class Part extends Document
{
    /**
     * Partname/Tag ID.
     */
    public string $partName = 'JQ';

    /**
     * Use minimized version of scripts ?
     */
    public static bool $useMinimizedJS = false;

    /**
     * Array of Part properties.
     */
    public array $partProperties = [];

    public function __construct()
    {
        parent::__construct();
        self::jQueryze();
    }

    /**
     * Set part name - mainly div id.
     *
     * @param string $partName jméno vložené části
     */
    public function setPartName($partName): void
    {
        $this->partName = $partName;
    }

    /**
     * Returns OnDocumentReady() JS code.
     *
     * @return string
     */
    public function onDocumentReady()
    {
        return '';
    }

    /**
     * Add Js/Css into page.
     */
    public function finalize(): void
    {
        $javaScript = $this->onDocumentReady();

        if ($javaScript) {
            WebPage::singleton()->addJavaScript($javaScript, null, true);
        }

        $this->finalized = true;
    }

    /**
     * Opatří objekt vším potřebným pro funkci jQuery.
     */
    public static function jQueryze(): void
    {
        WebPage::singleton()->includeJavaScript(
            WebPage::singleton()->jqueryJavaScript,
            0,
            !strstr(WebPage::singleton()->jqueryJavaScript, '://'),
        );
    }

    /**
     * Nastaví paramatry tagu.
     *
     * @param mixed $partProperties vlastnosti jQuery widgetu
     */
    public function setPartProperties($partProperties): void
    {
        if (\is_array($partProperties)) {
            if (\is_array($this->partProperties)) {
                $this->partProperties = array_merge(
                    $this->partProperties,
                    $partProperties,
                );
            } else {
                $this->partProperties = $partProperties;
            }
        } else {
            $propBuff = $partProperties;
            $this->partProperties = ' '.$propBuff;
        }
    }

    /**
     * Vyrendruje aktuální parametry části jako parametry pro jQuery.
     *
     * @param array|string $partProperties pole vlastností
     *
     * @return string
     */
    public function getPartPropertiesToString($partProperties = null)
    {
        if (!$partProperties) {
            $partProperties = $this->partProperties;
        }

        return self::partPropertiesToString($partProperties);
    }

    /**
     * vyrendruje pole parametrů jako řetězec v syntaxi javascriptu.
     *
     * @param array|string $partProperties vlastnosti jQuery widgetu
     *
     * @return string
     */
    public static function partPropertiesToString($partProperties)
    {
        if (\is_array($partProperties)) {
            $partPropertiesString = '';
            $partsArray = [];

            foreach ($partProperties as $partPropertyName => $partPropertyValue) {
                if (null !== $partPropertyName) {
                    if (is_numeric($partPropertyName)) {
                        if (
                            !strstr(
                                $partPropertiesString,
                                ' '.$partPropertyValue.' ',
                            )
                        ) {
                            $partsArray[] = ' '.$partPropertyValue.' ';
                        }
                    } else {
                        if (\is_array($partPropertyValue)) {
                            if (Functions::isAssoc($partPropertyValue)) {
                                if ($partPropertyName) {
                                    $partsArray[] = $partPropertyName.': { '.self::partPropertiesToString($partPropertyValue).' } ';
                                } else {
                                    $partsArray[] = self::partPropertiesToString($partPropertyValue);
                                }
                            } else {
                                foreach ($partPropertyValue as $key => $value) {
                                    if (\is_string($value)) {
                                        $partPropertyValue[$key] = '"'.$value.'"';
                                    }
                                }

                                if (\is_array($partPropertyValue)) {
                                    foreach ($partPropertyValue as $pId => $piece) {
                                        if (\is_array($piece)) {
                                            $partPropertyValue[$pId] = ' { '.self::partPropertiesToString($piece).' } ';
                                        }
                                    }

                                    $partsArray[] = $partPropertyName.': ['.implode(
                                        ',',
                                        $partPropertyValue,
                                    ).'] ';
                                } else {
                                    $partsArray[] = $partPropertyName.':'.$partPropertyValue;
                                }
                            }
                        } elseif (\is_int($partPropertyValue)) {
                            $partsArray[] = '"'.$partPropertyName.'": '.$partPropertyValue.' ';
                        } else {
                            if (\is_bool($partPropertyValue)) {
                                $partPropertyValue = $partPropertyValue ? 'true' : 'false';
                                $partsArray[] = $partPropertyName.': '.$partPropertyValue.' ';
                            } elseif (null !== $partPropertyValue && (\strlen($partPropertyValue) || $partPropertyValue === false)) {
                                if (
                                    (\strlen($partPropertyValue) > 7) && !substr_compare(
                                        $partPropertyValue,
                                        'function',
                                        0,
                                        8,
                                    ) || $partPropertyValue[0] === '{' || $partPropertyValue === true
                                ) {
                                    if ($partPropertyValue === true) {
                                        $partPropertyValue = 'true';
                                    }

                                    if ($partPropertyValue === false) {
                                        $partPropertyValue = 'false';
                                    }

                                    $partsArray[] = $partPropertyName.': '.$partPropertyValue.' ';
                                } else {
                                    $partsArray[] = $partPropertyName.': "'.$partPropertyValue.'" ';
                                }
                            }
                        }
                    }
                } else {
                    $partsArray[] = $partPropertyValue;
                }
            }

            return implode(
                <<<'EOD'
,

EOD,
                $partsArray,
            );
        }

        return $partProperties;
    }
}
