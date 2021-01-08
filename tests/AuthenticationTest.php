<?php

namespace App\tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Container8JI2lKD\getLexikJwtAuthentication_JwtManagerService;

class AuthenticationTest extends ApiTestCase
{
    public function testAccessToDentistsListWithoutTrueCredentials(): void
    {

        $response = static::createClient()->request('GET', '/api/dentists');

        $this->assertResponseStatusCodeSame('401');
    }

    public function testAccessToDentistsListWithTrueCredentials(): void
    {

        $response = static::createClient()->request('POST', '/api/login_check', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'username' => 'leslie29',
                'password' => 'password'
            ]
        ]);

        $this->assertResponseStatusCodeSame('200');

        $arrayResponse = $response->toArray();
        $token1 = $arrayResponse['token'];

        echo($token1);

        static::createClient()->request('GET', '/api/dentists', [
            'headers' => ['Authorization' => "Bearer $token1"]
        ]);

        $this->assertResponseStatusCodeSame('200');
    }
}
