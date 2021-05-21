<?php
declare (strict_types=1);

namespace Ease;

/**
 * jQuery common class.
 *  @author Vítězslav Dvořák <info@vitexsoftware.cz>, Jana Viktorie Borbina <jana@borbina.com>
 *
 */
class Part extends Document
{
	/**
	 * Partname/Tag ID.
	 *
	 * @var string
	 */
	public $partName = 'JQ';

	/**
	 * Use minimized version of scripts ?
	 *
	 * @var bool
	 */
	public static $useMinimizedJS = false;

	/**
	 * Array of Part properties.
	 *
	 * @var array
	 */
	public $partProperties = [];

	public function __construct()
	{
		parent::__construct();
		self::jQueryze();
	}

	/**
	 * Set part name - mainly div id.
	 *
	 * @param string $partName  name-inserted part
	 */
	public function setPartName($partName)
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
	public function finalize()
	{
		$javaScript = $this->onDocumentReady();
		if ($javaScript) {
			WebPage::singleton()->addJavaScript($javaScript, null, true);
		}
	}

	/**
	 * Provides the object with everything needed for the jQuery function.
	 */
	public static function jQueryze()
	{

		WebPage::singleton()->includeJavaScript(
			WebPage::singleton()->jqueryJavaScript,
			0,
			!strstr(WebPage::singleton()->jqueryJavaScript, '://')
		);
	}

	/**
	 * Sets tag properties.
	 *
	 * @param mixed $partProperties jQuery widget properties
	 */
	public function setPartProperties($partProperties)
	{
		if (is_array($partProperties)) {
			if (is_array($this->partProperties)) {
				$this->partProperties = array_merge(
					$this->partProperties,
					$partProperties
				);
			} else {
				$this->partProperties = $partProperties;
			}
		} else {
			$propBuff             = $partProperties;
			$this->partProperties = ' ' . $propBuff;
		}
	}

	/**
	 * Renders the current part parameters as parameters for jQuery.
	 *
	 * @param array|string $partProperties properties field
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
	 * renders an array of parameters as a string in javascript syntax.
	 *
	 * @param array|string $partProperties jQuery widget properties
	 *
	 * @return string
	 */
	public static function partPropertiesToString($partProperties)
	{
		if (is_array($partProperties)) {
			$partPropertiesString = '';
			$partsArray           = [];
			foreach ($partProperties as $partPropertyName => $partPropertyValue) {
				if (!is_null($partPropertyName)) {
					if (is_numeric($partPropertyName)) {
						if (!strstr(
							$partPropertiesString,
							' ' . $partPropertyValue . ' '
						)) {
							$partsArray[] = ' ' . $partPropertyValue . ' ';
						}
					} else {
						if (is_array($partPropertyValue)) {
							if (Functions::isAssoc($partPropertyValue)) {
								if ($partPropertyName) {
									$partsArray[] = $partPropertyName . ': { ' . self::partPropertiesToString($partPropertyValue) . ' } ';
								} else {
									$partsArray[] = self::partPropertiesToString($partPropertyValue);
								}
							} else {
								foreach ($partPropertyValue as $key => $value) {
									if (is_string($value)) {
										$partPropertyValue[$key] = '"' . $value . '"';
									}
								}
								if (is_array($partPropertyValue)) {
									foreach ($partPropertyValue as $pId => $piece) {
										if (is_array($piece)) {
											$partPropertyValue[$pId] = ' { ' . self::partPropertiesToString($piece) . ' } ';
										}
									}
									$partsArray[] = $partPropertyName . ': [' . implode(
										',',
										$partPropertyValue
									) . '] ';
								} else {
									$partsArray[] = $partPropertyName . ':' . $partPropertyValue;
								}
							}
						} elseif (is_int($partPropertyValue)) {
							$partsArray[] = '"' . $partPropertyName . '": ' . $partPropertyValue . ' ';
						} else {
							if (!is_null($partPropertyValue) && (strlen($partPropertyValue)
								|| $partPropertyValue === false)) {
								if ((strlen($partPropertyValue) > 7) && !substr_compare(
										$partPropertyValue,
										'function',
										0,
										8
									) || $partPropertyValue[0]
									== '{' || $partPropertyValue === true
								) {
									if ($partPropertyValue === true) {
										$partPropertyValue = 'true';
									}
									if ($partPropertyValue === false) {
										$partPropertyValue = 'false';
									}
									$partsArray[] = $partPropertyName . ': ' . $partPropertyValue . ' ';
								} else {
									$partsArray[] = $partPropertyName . ': "' . $partPropertyValue . '" ';
								}
							}
						}
					}
				} else {
					$partsArray[] = $partPropertyValue;
				}
			}
			$partPropertiesString = implode(
				',
',
				$partsArray
			);

			return $partPropertiesString;
		} else {
			return $partProperties;
		}
	}
}
