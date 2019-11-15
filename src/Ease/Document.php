<?php
/**
 * Simple html page class.
 *
 * @author     Vitex <vitex@hippy.cz>
 * @copyright  2009-2019 Vitex@hippy.cz (G)
 */

namespace Ease;

/**
 * Objekt určený k "pojmutí" obsahu - sám nemá žádnou viditelnou část.
 *
 * @author Vitex <vitex@hippy.cz>
 */
class Document extends Container
{
    /**
     * Saves obejct instace (singleton...).
     */
    private static $instance = null;

    /**
     * Odkaz na základní objekt stránky.
     *
     * @var WebPage
     */
    public static $webPage = null;

    /**
     * Které objekty převzít od přebírajícího objektu.
     *
     * @var array
     */
    public $raiseItems = ['SetUpUser' => 'User', 'webPage', 'OutputFormat'];

    /**
     * Odkaz na naposledy přidaný element.
     *
     * @var object
     */
    public $lastItem = null;

    /**
     * Is page closed for adding new contents ?
     *
     * @var bool
     */
    public static $pageClosed = false;

    /**
     * Pole odkazů na všechny vložené objekty.
     *
     * @var array pole odkazů
     */
    public static $allItems = [];

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
        return WebPage::singleton()->addJavaScript($javaScript, $position,
                $inDocumentReady);
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
        return WebPage::singleton()->includeJavaScript($javaScriptFile,
                $position);
    }

    /**
     * Add another CSS definition to stack.
     *
     * @param string $css css definice
     *
     * @return bool
     */
    public function addCSS($css)
    {
        return \Ease\webPage::singleton()->addCSS($css);
    }

    /**
     * Include an CSS file call into page.
     *
     * @param string $cssFile  cesta k souboru vkládanému do stránky
     * @param bool   $fwPrefix přidat prefix frameworku (obvykle /Ease/) ?
     * @param string $media    médium screen|print|braile apod ...
     *
     * @return boolean
     */
    public function includeCss($cssFile, $fwPrefix = false, $media = 'screen')
    {
        return WebPage::singleton()->includeCss($cssFile, $fwPrefix, $media);
    }

    /**
     * Perform http redirect
     * Provede http přesměrování.
     *
     * @param string $url adresa přesměrování
     */
    public function redirect($url)
    {
        $messages = Shared::instanced()->statusMessages;
        if (count($messages)) {
            $_SESSION['EaseMessages'] = $messages;
        }
        if (headers_sent()) {
            $this->addJavaScript('window.location = "'.$url.'"', 0, false);
        } else {
            header('Location: '.$url);
        }
        WebPage::$pageClosed = true;
    }

    /**
     * Vrací požadovanou adresu.
     *
     * @return string
     */
    public static function getUri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * Returns the current URL. This is instead of PHP_SELF which is unsafe.
     *
     * @param bool $dropqs whether to drop the querystring or not. Default true
     *
     * @return string the current URL or NULL for php-cli
     */
    public static function phpSelf($dropqs = true)
    {
        $url = null;
        if (php_sapi_name() != 'cli') {

            $schema = 'http';
            if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) {
                $schema .= 's';
            }
            $url = sprintf('%s://%s%s', $schema, $_SERVER['SERVER_NAME'],
                $_SERVER['REQUEST_URI']);

            $parts = parse_url($url);

            $port   = $_SERVER['SERVER_PORT'];
            $scheme = $parts['scheme'];
            $host   = $parts['host'];
            if (isset($parts['path'])) {
                $path = $parts['path'];
            } else {
                $path = null;
            }
            if (isset($parts['query'])) {
                $qs = $parts['query'];
            } else {
                $qs = null;
            }
            $port || $port = ($scheme == 'https') ? '443' : '80';

            if (($scheme == 'https' && $port != '443') || ($scheme == 'http' && $port
                != '80')
            ) {
                $host = "$host:$port";
            }
            $url = "$scheme://$host$path";
            if (!$dropqs) {
                $url = "{$url}?{$qs}";
            }
        }
        return $url;
    }

    /**
     * Nepřihlášeného uživatele přesměruje na přihlašovací stránku.
     *
     * @param string $loginPage adresa přihlašovací stránky
     */
    public function onlyForLogged($loginPage = 'login.php', $message = null)
    {

        if (!method_exists(\Ease\Shared::user(), 'isLogged') || !\Ease\Shared::user()->isLogged()) {
            if (!empty($message)) {
                \Ease\User::singleton()->addStatusMessage(_('Sign in first please'),
                    'warning');
            }
            $this->redirect($loginPage);
            self::$pageClosed = true;
        }
    }

    /**
     * Include next element into current page (if not closed).
     *
     * @param mixed  $pageItem     value or EaseClass with draw() method
     *
     * @return null|Embedable Pointer to included object
     */
    public function addItem($pageItem)
    {
        return self::$pageClosed ? null : parent::addItem($pageItem);
    }

    /**
     * Vrací pole $_REQUEST.
     *
     * @return array
     */
    public function getRequestValues()
    {
        return $_REQUEST;
    }

    /**
     * Is page called by Form Post ?
     *
     * @return bool
     */
    public static function isPosted()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Ošetří proměnou podle jejího očekávaného typu.
     *
     * @param mixed  $value      hodnota
     * @param string $sanitizeAs typ hodnoty int|string|float|null
     *
     * @return mixed
     */
    public static function sanitizeAsType($value, $sanitizeAs)
    {
        $sanitized = null;
        switch ($sanitizeAs) {
            case 'string':
                $sanitized = (string) $value;
                break;
            case 'int':
                $sanitized = strlen($value) ? (int) $value : null;
                break;
            case 'float':
                $sanitized = (float) $value;
                break;
            case 'bool':
            case 'boolean':
                switch ($value) {
                    case 'FALSE':
                    case 'false':
                        $sanitized = false;
                        break;
                    case 'true':
                    case 'TRUE':
                        $sanitized = true;
                        break;
                    default:
                        $sanitized = boolval($value);
                        break;
                }
                break;
            case 'null':
            default:
                $sanitized = $value;
                break;
        }

        return $sanitized;
    }

    /**
     * Vrací hodnotu klíče prametru volání stránky.
     *
     * @param string $field      klíč POST nebo GET
     * @param string $sanitizeAs ošetřit vrácenou hodnotu jako float|int|string
     *
     * @return mixed
     */
    public static function getRequestValue($field, $sanitizeAs = null)
    {
        $value = null;
        if (isset($_REQUEST[$field])) {
            $value = empty($sanitizeAs) ? $_REQUEST[$field] : self::sanitizeAsType($_REQUEST[$field],
                    $sanitizeAs);
        }
        return $value;
    }

    /**
     * Vrací hodnotu klíče pramatru volání stránky.
     *
     * @param string $field      klíč GET
     * @param string $sanitizeAs ošetřit vrácenou hodnotu jako float|int|string
     *
     * @return string
     */
    public static function getGetValue($field, $sanitizeAs = null)
    {
        $value = null;
        if (isset($_GET[$field])) {
            $value = empty($sanitizeAs) ? $_GET[$field] : self::sanitizeAsType($_GET[$field],
                    $sanitizeAs);
        }
        return $value;
    }

    /**
     * Vrací hodnotu klíče pramatru volání stránky.
     *
     * @param string $field      klíč POST
     * @param string $sanitizeAs ošetřit vrácenou hodnotu jako float|int|string
     *
     * @return string
     */
    public static function getPostValue($field, $sanitizeAs = null)
    {
        $value = null;
        if (isset($_POST[$field])) {
            $value = empty($sanitizeAs) ? $_POST[$field] : self::sanitizeAsType($_POST[$field],
                    $sanitizeAs);
        }
        return $value;
    }

    /**
     * Byla stránka zobrazena po odeslání formuláře metodou POST ?
     *
     * @category requestValue
     *
     * @return bool
     */
    public static function isFormPosted()
    {
        return isset($_POST) && count($_POST);
    }

    /**
     * Vrací pole jako parametry URL.
     *
     * @param array  $params
     * @param string $baseUrl
     */
    public static function arrayToUrlParams($params, $baseUrl = '')
    {
        if (strstr($baseUrl, '?')) {
            return $baseUrl.'&'.http_build_query($params);
        } else {
            return $baseUrl.'?'.http_build_query($params);
        }
    }

    /**
     * Zaregistruje položku k finalizaci.
     *
     * @param mixed $itemPointer
     */
    public static function registerItem(&$itemPointer)
    {
        self::$allItems[] = $itemPointer;
    }

    /**
     * Vrací nebo registruje instanci webové stránky.
     *
     * @param WebPage $oPage objekt webstránky k zaregistrování
     *
     * @return WebPage
     */
    public static function &webPage($oPage = null)
    {
        if (is_object($oPage)) {
            self::$webPage = &$oPage;
        }
        if (!is_object(self::$webPage)) {
            self::$webPage = WebPage::singleton();
        }
        return self::$webPage;
    }

    /**
     * @return WebPage
     */
    public static function singleton()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
