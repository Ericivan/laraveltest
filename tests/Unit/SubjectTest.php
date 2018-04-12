<?php

namespace Tests\Unit;

use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\SocialiteManager;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubjectTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testObserversAreUpdated()
    {
        $observer = $this->getMockBuilder(Observer::class)
            ->setMethods(['update'])
            ->getMock();

        $observer->expects($this->once())
            ->method('update')
            ->with($this->equalTo('something'));

        $subject = new Subject('My subject');

        $subject->attach($observer);

        $subject->doSomethine();


    }

    public function testProvider()
    {
        SocialiteManager::driver('github');
        Socialite::driver('github');
    }
}
