<?php

class TakeParamCest
{
    public function testThreeParam(ApiTester $I)
    {
        $I->wantTo('Check if a triangle can take three parameters');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendGet('/triangle/possible', [
            'a' => 1,
            'b' => 2,
            'c' => 2
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['isPossible' => true]);
    }

    public function testOneParam(ApiTester $I)
    {
        $I->wantTo('Check if a triangle can take one parameters');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendGet('/triangle/possible', [
            'a' => 1,
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => ['error' => 'Not valid data']]);
    }

    public function testTwoParam(ApiTester $I)
    {
        $I->wantTo('Check if a triangle can take two parameters');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendGet('/triangle/possible', [
            'a' => '-aSd',
            'b' => '-aSd'
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => ['error' => 'Not valid data']]);
    }

    public function testFourParam(ApiTester $I)
    {
        $I->wantTo('Check if a triangle can take four parameters');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendGet('/triangle/possible', [
            'a' => 1,
            'b' => 2,
            'c' => 2,
            'd' => 2
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => ['error' => 'Not valid data']]);
    }

    public function testThreeAnotherParam(ApiTester $I)
    {
        $I->wantTo('Check if a triangle can take three another parameters');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendGet('/triangle/possible', [
            'a' => 1,
            'b' => 2,
            'd' => 2
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => ['error' => 'Not valid data']]);

        $I->sendGet('/triangle/possible', [
            'A' => 1,
            'B' => 2,
            'C' => 2
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => ['error' => 'Not valid data']]);

        $I->sendGet('/triangle/possible', [
            'б' => 1,
            'г' => 2,
            'ж' => 2
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => ['error' => 'Not valid data']]);
    }
}
