<?php

declare(strict_types=1);


namespace Tests\Api;

use Codeception\Util\HttpCode;
use Tests\Support\ApiTester;

final class DogsBreedCest
{

    public function _before(ApiTester $I): void
    {
        // Code here will be executed before each test.
    }
    
    /**
     * @group dogAPI
    */
    public function verifyThatEndpointReturnsAllImagesByBreed(ApiTester $I): void
    {

        $endpoint = '/breed/hound/images';

        $I->sendGet($endpoint);

        $I->seeResponseCodeIs(HttpCode::OK);

        $I->seeResponseContainsJson();

        $I->seeResponseMatchesJsonType([
            'message' => 'array',
            'status' => 'string'
        ]);
    }

    /**
     * @group dogAPI
    */
    public function verifyNotFoundWhenBreedIsNotAvailable(ApiTester $I): void
    {

        $endpoint = '/breed/hoopopund/images';

        $I->sendGet($endpoint);

        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);

        $I->seeResponseContainsJson();

        $I->seeResponseContainsJson([
            'code' => '404',
        ]);
    }

    /**
     * @group dogAPI
    */
    public function verifyServerRespondsWithAListOfBreeds(ApiTester $I) {

        $endpoint = '/breeds/list/all';

        $I->sendGet($endpoint);

        $I->seeResponseCodeIs(HttpCode::OK);

        $I->seeResponseContainsJson();

        $I->seeResponseMatchesJsonType([
            'message' => 'array',
            "status" => "string"
        ]);

        // Check if 'status' is 'success'
        $I->seeResponseContainsJson(['status' => 'success']);
    }

    /**
     * @group dogAPI
    */
    public function verifyServerRespondsWithARandomImage(ApiTester $I) {

        $endpoint = '/breeds/image/random';

        $I->sendGet($endpoint);

        $I->seeResponseCodeIs(HttpCode::OK);

        $I->seeResponseContainsJson();

        $I->seeResponseMatchesJsonType([
            'message' => 'string',
            "status" => "string"
        ]);

        // Check if 'status' is 'success'
        $I->seeResponseContainsJson(['status' => 'success']);
    }

    /**
     * @group dogAPI
    */
    public function verifyServerRespondsWithAListOfSubBreeds(ApiTester $I) {

        $endpoint = '/breed/hound/list';

        $I->sendGet($endpoint);

        $I->seeResponseCodeIs(HttpCode::OK);

        $I->seeResponseContainsJson();

        $I->seeResponseMatchesJsonType([
            'message' => 'array',
            "status" => "string"
        ]);

        // Check if 'status' is 'success'
        $I->seeResponseContainsJson(['status' => 'success']);
    }

    /**
     * @group dogAPI
    */
    public function verifyErrorWhenSubBreedISNotAvailable(ApiTester $I) {

        $endpoint = '/breed/houbdbdfdfbdbdfbnd/list';

        $I->sendGet($endpoint);

        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);

        $I->seeResponseContainsJson();

        $I->seeResponseMatchesJsonType([
            'message' => 'string',
            "status" => "string",
        ]);

        // Check if 'status' is 'success'
        $I->seeResponseContainsJson(['code' => 404]);
    }
}
