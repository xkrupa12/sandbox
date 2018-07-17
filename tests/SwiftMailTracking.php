<?php

namespace Tests;

use Illuminate\Support\Facades\Mail;
use Swift_Events_EventListener;
use Swift_Events_SendEvent;
use Swift_Mime_SimpleMessage;

trait SwiftMailTracking
{
    /**
     * @var array
     */
    protected $emails = [];

    /** @before */
    public function setUpMailTracking(): void
    {
        Mail::getSwiftMailer()->registerPlugin(
            new class($this) implements Swift_Events_EventListener {
                /**
                 * @var TestCase
                 */
                private $test;

                /**
                 * @param TestCase $test
                 */
                public function __construct(TestCase $test)
                {
                    $this->test = $test;
                }

                /**
                 * @param $event
                 */
                public function beforeSendPerformed(Swift_Events_SendEvent $event): void
                {
                    $this->test->addEmail($event->getMessage());
                }
            }
        );
    }

    /**
     * @param Swift_Mime_SimpleMessage $email
     */
    public function addEmail(Swift_Mime_SimpleMessage $email): void
    {
        $this->emails[] = $email;
    }

    /**
     * @param string $sender
     *
     * @return TestCase
     */
    protected function seeSenderIs(string $sender): TestCase
    {
        $senders = array_reduce($this->emails, function (array $carry, Swift_Mime_SimpleMessage $email) {
            $carry = array_merge($carry, array_keys($email->getFrom()));

            return array_unique($carry);
        }, []);

        $this->assertTrue(\in_array($sender, $senders, true));

        return $this;
    }

    /**
     * @return TestCase
     */
    protected function seeEmailWasSent(): TestCase
    {
        $this->assertNotEmpty($this->emails, 'No emails have been sent');

        return $this;
    }

    /**
     * @param int $count
     *
     * @return TestCase
     */
    protected function seeEmailsSent(int $count): TestCase
    {
        $this->assertCount(
            $count,
            $this->emails,
            sprintf('Expected %s emails to be sent, but %s has been sent', $count, \count($this->emails))
        );

        return $this;
    }
}
