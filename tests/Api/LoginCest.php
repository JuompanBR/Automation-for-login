<?php

declare(strict_types=1);

namespace Tests\Api;

use Tests\Support\ApiTester;
use Exception;

use function PHPUnit\Framework\matches;

final class LoginCest
{
    private string $testDataFilePath = 'login_testdata.json';
    private string $csrfToken;

    // public function __construct()
    // {
    //     $this->testDataFilePath = codecept_data_dir('testData.csv');
    // }

    public function _before(ApiTester $I): void
    {
        // Load the login page
        $I->sendGET('/login');
        $I->seeResponseCodeIs(200); // Ensure the request was successful

        // Grab the raw HTML response
        $response = $I->grabResponse();

        // Extract CSRF token using regex
        if (preg_match('/name="signin\[_csrf_token\]" value="([^"]+)" id="signin__csrf_token"/', $response, $matches)) {
            $this->csrfToken = $matches[1]; // Extract token from match
        } else {
            throw new Exception('CSRF token not found in login page response');
        }

        // Set the CSRF token in cookies
        $I->setCookie('smopamobilpay', $this->csrfToken);

        echo "Set the token to be {$this->csrfToken}";
    }


    /**
     * @return string
     */
    protected function getTestDataPath(): string
    {

        return $this->testDataFilePath;
    }

    /**
     * @param APITester $I
     * @param array|null $data
     * @return void
     */
    public function loginFunctionalityTesting(APITester $I, array $data): void
    {

        // Set the appropriate headers here
        $I->haveHttpHeader('accept', 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,/;q=0.8,application/signed-exchange;v=b3;q=0.7');
        $I->haveHttpHeader('accept-encoding', 'gzip, deflate, br, zstd');
        $I->haveHttpHeader('origin', 'https://smobilpay.staging.maviance.info');
        $I->haveHttpHeader('referer', ' https://smobilpay.staging.maviance.info/login');

        // Set the body parameters of the login endpoint
        $I->sendPostAsJson('/login', [
            'signin[_csrf_token]' => $this->csrfToken,
            'signin[username]' => 'tech-interns@cm.maviance.com',
            'signin[password]' => 'Tech@12345',
            'login' => 'LOG+IN'
        ]);
        // $I->seeResponseCodeIs(200);
    }
}
