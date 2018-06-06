<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @param User|null $user
     *
     * @return self
     */
    public function signIn(User $user = null): self
    {
        $this->actingAs($user ?? create(User::class));

        return $this;
    }
}
