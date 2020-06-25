<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function login($email)
    {
        return $this->json('POST', '/api/v1/auth/login', [
            'email' => $email,
            'password' => 'secret',
        ]);
    }

    public function user($token)
    {
        return $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->json('GET', '/api/v1/auth/me')->decodeResponseJson();
    }
}
