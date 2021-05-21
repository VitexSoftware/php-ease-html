<?php
declare (strict_types=1);
/**
 * Html form able to be recursive filled
 * Html formulář se schopností rekurzivne naplnit hodnotami vložené prvky.
 *
 * @author Vítězslav Dvořák <vitex@hippy.cz>
 */

namespace Ease\Html;

class Form extends PairTag
{
    /**
     * Cíl formu.
     *
     * @var string URL cíle formuláře
     */
    public $formTarget = null;

    /**
     * Metoda odesílání.
     *
     * @var string GET|POST
     */
    public $formMethod = null;

    /**
     * Nastavovat formuláři jméno ?
     *
     * @var boolean
     */
    public $setName = false;

    /**
     * Html Form Tag
     *
     * @param array  $tagProperties vlastnosti tagu například:
     *                              array('enctype' => 'multipart/form-data')
     * @param mixed  $formContents  prvky uvnitř formuláře
     */
    public function __construct($tagProperties = [], $formContents = null)
    {
        if(!array_key_exists('method', $tagProperties)){
            $tagProperties['method'] = 'POST';
        }
        parent::__construct('form', $tagProperties, $formContents);
    }

    /**
     * Pokusí se najít ve vložených objektech tag zadaného jména.
     *
     * @param string        $searchFor jméno hledaného elementu
     * @param \Ease\Container $where     objekt v němž je hledáno
     *
     * @return \Ease\Container
     */
    public function &objectContentSearch($searchFor, $where = null)
    {
        if (is_null($where)) {
            $where = &$this;
        }
        $itemFound = null;
        if (isset($where->pageParts) && is_array($where->pageParts) && count($where->pageParts)) {
            foreach ($where->pageParts as $pagePart) {
                if (is_object($pagePart)) {
                    if (method_exists($pagePart, 'getTagName')) {
                        if ($pagePart->getTagName() == $searchFor) {
                            return $pagePart;
                        }
                    } else {
                        $itemFound = $this->objectContentSearch($searchFor,
                            $pagePart);
                        if ($itemFound) {
                            return $itemFound;
                        }
                    }
                }
            }
        }

        return $itemFound;
    }

    /**
     * Naplní vložené objekty daty.
     *
     * @param string $data asociativní pole dat
     */
    public function fillUp($data = null)
    {
        if (is_null($data)) {
            $data = $this->getData();
        }
        self::fillMeUp($data, $this);
    }

    /**
     * Projde všechny vložené objekty a pokud se jejich jména shodují s klíči
     * dat, nastaví se jim hodnota.
     *
     * @param array           $data asociativní pole dat
     * @param \Ease\Container|mixed $form formulář k naplnění
     */
    public static function fillMeUp($data, &$form)
    {
        if (!empty($form->pageParts)) {
            foreach ($form->pageParts as $partName => $part) {
                if (!empty($part->pageParts)) {
                    self::fillMeUp($data, $part);
                }
                if (is_object($part)) {
                    if (method_exists($part, 'setValue') && method_exists($part,
                            'getTagName')) {
                        $tagName = $part->getTagName();
                        if (isset($data[$tagName])) {
                            $part->setValue($data[$tagName], true);
                        }
                    }
                    if (method_exists($part, 'setValues')) {
                        $part->setValues($data);
                    }
                }
            }
        }
    }
}
