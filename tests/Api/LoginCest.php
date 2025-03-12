<?php

declare(strict_types=1);

namespace Tests\Api;

use Tests\Support\ApiTester;
use Exception;

use function PHPUnit\Framework\matches;
use DOMDocument;

final class LoginCest
{
    private string $testDataFilePath = 'login_testdata.json';
    private string $csrfToken;

    // public function __construct()
    // {
    //     $this->testDataFilePath = codecept_data_dir('testData.csv');
    // }

    // public function _before(ApiTester $I, DOMDocument $htmlParser): void
    // {
    //     // Load the login page
    //     $I->sendGET('/login');
    //     // $I->seeResponseCodeIs(200); // Ensure the request was successful

    //     // Grab the raw HTML response
    //     $response = $I->grabResponse();

    //     // parse the html document
    //     $dom = new DOMDocument();
    //     @ $dom->loadHTML($response);

    //     // Get the csrf token
    //     $this->csrfToken = $dom->getElementById('signin__csrf_token')->getAttribute('value');

    //     echo $this->csrfToken;

    //     // Set the CSRF token in cookies
    //     $I->haveHttpHeader('Cookie', "smopamobilpay=".$this->csrfToken);
    // }


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
    public function loginFunctionalityTesting(APITester $I): void
    {

        // Set the appropriate headers here
        $I->haveHttpHeader('Content-Type', 'multipart/form-data');
        $I->haveHttpHeader('accept', 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,/;q=0.8,application/signed-exchange;v=b3;q=0.7');
        $I->haveHttpHeader('accept-encoding', 'gzip, deflate, br, zstd');
        $I->haveHttpHeader('origin', 'https://smobilpay.staging.maviance.info');
        $I->haveHttpHeader('referer', ' https://smobilpay.staging.maviance.info/login');
        $I->haveHttpHeader('user-agent', ' Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36');
        $I->haveHttpHeader('sec-fetch-site', 'same-origin');
        $I->haveHttpHeader('Cookie', "smopamobilpay=cd5b363f340d69bcffe50e2804f00626");

        // Set the body parameters of the login endpoint
        $I->sendPOST('/login', [
            'signin[_csrf_token]' => 'cd5b363f340d69bcffe50e2804f00626',
            'signin[username]' => 'tech-interns@cm.maviance.com',
            'signin[password]' => 'Tech@12345',
            'login' => 'LOG+IN'
        ]);
        $I->seeResponseCodeIs(200);
    }
}
