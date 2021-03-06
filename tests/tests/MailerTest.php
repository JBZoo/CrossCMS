<?php
/**
 * JBZoo CrossCMS
 *
 * This file is part of the JBZoo CCK package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package   CrossCMS
 * @license   MIT
 * @copyright Copyright (C) JBZoo.com,  All rights reserved.
 * @link      https://github.com/JBZoo/CrossCMS
 * @author    Denis Smetannikov <denis@jbzoo.com>
 */

namespace JBZoo\PHPUnit;

use JBZoo\CrossCMS\AbstractMailer;
use JBZoo\CrossCMS\Cms;

/**
 * Class MailerTest
 * @package JBZoo\PHPUnit
 */
class MailerTest extends CrossCMSUnit
{
    public function testSimpleMessage()
    {
        $mail = $this->_cms['mailer']->clean();

        isTrue($mail->setTo('admin@example.com'));
        isTrue($mail->setSubject('Test message subject'));
        isTrue($mail->setBody('Simple test'));

        isTrue($mail->send());
    }

    public function testHTMLMessage()
    {
        $mail = $this->_cms['mailer']->clean();

        isTrue($mail->setTo('admin@example.com'));
        isTrue($mail->setSubject('Test message subject'));
        isTrue($mail->setBody('<body><strong>Test message: HTML enabled</strong></body>'));

        isTrue($mail->send());
    }

    public function testNoHTMLMessage()
    {
        $mail = $this->_cms['mailer']->clean();

        isTrue($mail->setTo('admin@example.com'));
        isTrue($mail->setSubject('Test message subject'));
        isTrue($mail->setBody('<body><strong>Test message: HTML disabled</strong></body>'));
        $mail->isHtml(false);

        isTrue($mail->send());
    }

    public function testSetFrom()
    {
        $mail = $this->_cms['mailer']->clean();

        isTrue($mail->setTo('admin@example.com'));
        isTrue($mail->setSubject('Test message subject'));
        isTrue($mail->setBody('Test message from no-replay@example.com'));
        $mail->setFrom('no-replay@example.com');

        isTrue($mail->send());
    }

    public function testSetFromWithName()
    {
        $mail = $this->_cms['mailer']->clean();

        isTrue($mail->setTo('admin@example.com'));
        isTrue($mail->setSubject('Test message subject'));
        isTrue($mail->setBody('Test message from no-replay@example.com (Website name)'));
        $mail->setFrom('no-replay@example.com', 'Website name');

        isTrue($mail->send());
    }

    public function testSetHeaders()
    {
        $mail = $this->_cms['mailer']->clean();

        isTrue($mail->setTo('admin@example.com'));
        isTrue($mail->setSubject('Test message subject'));

        isTrue($mail->setBody('Test message with CC&BCC headers'));
        $mail->setHeaders(array(
            'Cc'  => 'John Smith <john@smith.org>',
            'Bcc' => 'Mike Smith <mike@smith.org>',
        ));

        isTrue($mail->send());
    }

    public function testSetOneHeader()
    {
        $mail = $this->_cms['mailer']->clean();

        isTrue($mail->setTo('admin@example.com'));
        isTrue($mail->setSubject('Test message subject'));

        isTrue($mail->setBody('Test message with only CC-header'));
        isTrue($mail->setHeader('Cc', 'John Smith <john@smith.org>'));

        isTrue($mail->send());
    }

    public function testAddAttachment()
    {
        $mail = $this->_cms['mailer']->clean();

        isTrue($mail->setTo('admin@example.com'));
        isTrue($mail->setSubject('Test message subject'));

        isTrue($mail->setBody('Test message with simple attach'));
        isTrue($mail->addAttachment(__FILE__));

        isTrue($mail->send());
    }

    public function testAddAttachmentWithName()
    {
        $mail = $this->_cms['mailer']->clean();

        isTrue($mail->setTo('admin@example.com'));
        isTrue($mail->setSubject('Test message subject'));

        isTrue($mail->setBody('Test message with customized attach'));
        isTrue($mail->addAttachment(__FILE__, 'Some custom name'));

        isTrue($mail->send());
    }

    public function testComplex()
    {
        $mail = $this->_cms['mailer']->clean();

        isTrue($mail->complex('admin@example.com', 'Test message subject', 'Test complex method'));
    }

    /**
     * @expectedException \JBZoo\CrossCMS\Exception\MailerException
     */
    public function testEmptySubjectException()
    {
        $mail = $this->_cms['mailer']->clean();

        isTrue($mail->setTo('admin@example.com'));
        isFalse($mail->setSubject(' '));
        isTrue($mail->setBody('Test empty subject'));

        $mail->send();
    }

    /**
     * @expectedException \JBZoo\CrossCMS\Exception\MailerException
     */
    public function testEmptyBodyException()
    {
        $mail = $this->_cms['mailer']->clean();

        isTrue($mail->setTo('admin@example.com'));
        isTrue($mail->setSubject('Test empty body'));
        isFalse($mail->setBody(' '));

        $mail->send();
    }

    /**
     * @expectedException \JBZoo\CrossCMS\Exception\MailerException
     */
    public function testEmptyRecipientException()
    {
        $mail = $this->_cms['mailer']->clean();

        isFalse($mail->setTo('no valid email'));
        isTrue($mail->setSubject('Test empty recipient'));
        isTrue($mail->setBody('Test empty recipient'));

        $mail->send();
    }

    public function testDisableValidation()
    {
        $mail = $this->_cms['mailer']->clean();

        $mail->setValidateMode(AbstractMailer::VALIDATE_NO_EXEPTION);

        isFalse($mail->send());
    }
}
