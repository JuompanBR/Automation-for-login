<?php

declare(strict_types=1);


namespace Tests\Api;

use Tests\Support\ApiTester;

final class registerCest
{
    private ?array $testData;

    public function _before(ApiTester $I): void
    {
        $file_path = codecept_data_dir('register/register_testdata.json');
        $this->testData = json_decode(file_get_contents($file_path), true);
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Content-Length', '66');
        $I->haveHttpHeader('Host', 'reqres.in');
        $I->haveHttpHeader('User-Agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
        $I->haveHttpHeader('Postman-Token', '4f843c0e-d17c-4e40-9485-b07fe512f5e9');
    }

    public function iVerifyServerResponseWithGeneratedIDAndTokensUserRegistrationReponse(ApiTester $I): void
    {
        // Encode the payload to json
        $jsonPayload = json_encode($this->testData['valid_testdata']);

        $I->sendPost('/api/register', $jsonPayload);

        // Assert the response object
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            "id" => 'integer',
            "token" => 'string'
        ]);
    }
}
