<?php

namespace Tests;

use App\Models\Resource;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function removeTestData(int $user_id)
    {
        User::findOrFail($user_id)->delete();
    }
}
