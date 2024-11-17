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
 * HTML ✉Class.
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>, Jana Viktorie Borbina <jana@borbina.com>
 * @copyright 2009-2024 vitex@hippy.cz (G)
 */

use Ease\Html\BodyTag;
use Ease\Html\HtmlTag;
use Ease\Html\SimpleHeadTag;
use Ease\Html\TitleTag;

/**
 * Build & Send email.
 */
class HtmlMailer extends Document
{
    /**
     * Object for sending mail.
     */
    public $mailer;
    public $mimer;
    public $textBody;
    public $mailHeaders = [];
    public $mailHeadersDone;
    public $crLf = "\n";
    public $mailBody;
    public bool $finalized = false;

    /**
     * Already rendered HTML.
     */
    public string $htmlBodyRendered = '';

    /**
     * Sender's email address.
     */
    public string $emailAddress = '';

    /**
     * Subject of email.
     */
    public string $emailSubject = '';

    /**
     * Sender's email address.
     */
    public string $fromEmailAddress = '';

    /**
     * Show user information about sending a message?
     */
    public bool $notify = true;

    /**
     * Has the message already been sent?
     */
    public ?bool $sendResult = false;

    /**
     * Page object for rendering to email.
     */
    public Container $htmlDocument;
    public ?Html\SimpleHeadTag $htmlHead = null;

    /**
     * Pointer to the BODY html document.
     *
     * @var null|BodyTag|Embedable
     */
    public $htmlBody;

    /**
     * Outgoing mail parameters.
     */
    public array $parameters = [];

    /**
     * Ease Mail - compiles and sends.
     *
     * @param string $emailAddress  address
     * @param string $mailSubject   subject
     * @param mixed  $emailContents body - any mix of text and EaseObjects
     * @param array  $headers       override Mail Headers
     */
    public function __construct(
        string $emailAddress,
        string $mailSubject,
        string $emailContents = '',
        array $headers = []
    ) {
        if (\Ease\Shared::cfg('EASE_SMTP')) {
            $this->parameters = (array) json_decode(\Ease\Shared::cfg('EASE_SMTP'));
        }

        if (\is_array($emailAddress)) {
            $emailAddress = current($emailAddress).' <'.key($emailAddress).'>';
        }

        $this->setMailHeaders(
            array_merge([
                'To' => $emailAddress,
                'From' => $this->fromEmailAddress,
                'Reply-To' => $this->fromEmailAddress,
                'Subject' => $mailSubject,
                'Content-Type' => 'text/html; charset=utf-8',
                'Content-Transfer-Encoding' => '8bit',
            ], $headers),
        );

        $mimer_params = [
            'html_charset' => 'utf-8',
            'text_charset' => 'utf-8',
            'head_charset' => 'utf-8',
            'eol' => $this->crLf,
        ];

        $this->mimer = new \Mail_mime($mimer_params);

        parent::__construct();

        $this->htmlDocument = new HtmlTag();
        $this->htmlHead = $this->htmlDocument->addItem(new SimpleHeadTag(new TitleTag($this->emailSubject)));
        $this->htmlBody = $this->htmlDocument->addItem(new BodyTag($emailContents));
    }

    /**
     * Returns the contents of the mail header.
     *
     * @param string $headername header name
     *
     * @return string
     */
    public function getMailHeader(string $headername)
    {
        return \array_key_exists($this->mailHeaders, $headername) ? $this->mailHeaders[$headername] : '';
    }

    /**
     * Sets mail headers.
     *
     * @param mixed $mailHeaders associative array of headers
     *
     * @return bool true            if the headers have been set
     */
    public function setMailHeaders(array $mailHeaders)
    {
        $this->mailHeaders = array_merge($this->mailHeaders, $mailHeaders);

        if (isset($this->mailHeaders['To'])) {
            $this->emailAddress = $this->mailHeaders['To'];
        }

        if (isset($this->mailHeaders['From'])) {
            $this->fromEmailAddress = $this->mailHeaders['From'];
        }

        if (isset($this->mailHeaders['Subject'])) {
            if (!strstr($this->mailHeaders['Subject'], '=?UTF-8?B?')) {
                $this->emailSubject = $this->mailHeaders['Subject'];
                $this->mailHeaders['Subject'] = '=?UTF-8?B?'.base64_encode($this->mailHeaders['Subject']).'?=';
            }
        }

        $this->finalized = false;

        return true;
    }

    /**
     * Adds an item to the body of the mail.
     *
     * @param mixed $item EaseObject or anything with the draw (); method
     *
     * @return mixed pointer to the inserted content
     */
    public function &addItem($item)
    {
        $added = $this->htmlBody->addItem($item);

        return $added;
    }

    /**
     * Gives you current Body.
     *
     * @return BodyTag
     */
    public function getContents()
    {
        return $this->htmlBody;
    }

    /**
     * Obtain item count.
     */
    public function getItemsCount(): int
    {
        return $this->htmlBody->getItemsCount();
    }

    /**
     * Is object empty ?
     */
    public function isEmpty(): bool
    {
        return $this->htmlBody->isEmpty();
    }

    /**
     * Empty container contents.
     */
    public function emptyContents(): void
    {
        $this->htmlBody->emptyContents();
    }

    /**
     * Attaches an attachment from a file to the mail.
     *
     * @param string $filename path / file name to attach
     * @param string $mimeType MIME attachment type
     *
     * @return bool file attachment successful
     */
    public function addFile($filename, $mimeType = 'text/plain')
    {
        return $this->mimer->addAttachment($filename, $mimeType);
    }

    /**
     * Builds the body of the mail.
     */
    #[\Override]
    public function finalize(): void
    {
        if (method_exists($this->htmlDocument, 'GetRendered')) {
            $this->htmlBodyRendered = $this->htmlDocument->getRendered();
        } else {
            $this->htmlBodyRendered = $this->htmlDocument;
        }

        $this->mimer->setHTMLBody($this->htmlBodyRendered);

        if (isset($this->fromEmailAddress)) {
            $this->setMailHeaders(['From' => $this->fromEmailAddress]);
        }

        $this->setMailHeaders(['Date' => date('r')]);
        $this->mailBody = $this->mimer->get();
        $this->mailHeadersDone = $this->mimer->headers($this->mailHeaders);
        parent::finalize();
    }

    /**
     * Do not draw mail included in page.
     */
    #[\Override]
    public function draw(): void
    {
        $this->drawStatus = true;
    }

    /**
     * Send mail.
     */
    public function send(): bool
    {
        if (!$this->finalized) {
            $this->finalize();
        }

        $oMail = new \Mail();

        if (\count($this->parameters)) {
            $this->mailer = $oMail->factory('smtp', $this->parameters);
        } else {
            $this->mailer = $oMail->factory('mail');
        }

        $sendresult = $this->mailer->send(
            $this->emailAddress,
            $this->mailHeadersDone,
            $this->mailBody,
        );

        $this->sendResult = \is_bool($sendresult) ? $sendresult : false;

        if (\is_object($this->sendResult) && \get_class($this->sendResult) === 'PEAR_Error') {
            throw new \Ease\Exception($this->sendResult->getMessage());
        }

        if ($this->notify === true) {
            $mailStripped = str_replace(['<', '>'], '', $this->emailAddress);

            if ($this->sendResult === true) {
                $this->addStatusMessage(sprintf(_('Message %s was sent to %s'), $this->emailSubject, $mailStripped), 'success');
            } else {
                $this->addStatusMessage(sprintf(
                    _('Message %s, for %s was not sent because of %s'),
                    $this->emailSubject,
                    $mailStripped,
                    $sendresult->message,
                ), 'warning');
            }
        }

        return $this->sendResult;
    }

    /**
     * Sets the user notification flag.
     *
     * @param bool $notify required notification status
     */
    public function setUserNotification($notify): void
    {
        $this->notify = (bool) $notify;
    }

    /**
     * Inserts another element after the existing one.
     *
     * @param mixed $pageItem value or EaseObject with draw () method
     *
     * @return Container A link to the embedded object
     */
    public function &addNextTo($pageItem)
    {
        $itemPointer = $this->htmlBody->parentObject->addItem($pageItem);

        return $itemPointer;
    }
}
