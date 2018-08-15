<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\ExpectationFailedException;
use SebastianBergmann\RecursionContext\InvalidArgumentException;
use Tests\SwiftMailTracking;
use Tests\TestCase;

class MailTest extends TestCase
{
    use SwiftMailTracking;

    /**
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testExample(): void
    {
        Mail::raw('Hello world', function ($message) {
            $message->to('recipient@gmail.com');
            $message->from('sender@gmail.com');
        });

        $this->seeSenderIs('sender@gmail.com');
        $this->seeEmailWasSent();
        $this->seeEmailsSent(1);
    }
}
