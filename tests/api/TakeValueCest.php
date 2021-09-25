<?php

class TakeValueCest
{
    public function testNaturalValues(ApiTester $I)
    {
        $I->wantTo('Check if a triangle can take natural values');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendGet('/triangle/possible', [
            'a' => 6,
            'b' => 9,
            'c' => 9
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['isPossible' => true]);

        $I->sendGet('/triangle/possible', [
            'a' => 645674,
            'b' => 665677,
            'c' => 915675
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['isPossible' => true]);

        $I->sendGet('/triangle/possible', [
            'a' => 6,
            'b' => 9,
            'c' => 10
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['isPossible' => true]);

        $I->sendGet('/triangle/possible', [
            'a' => 645604,
            'b' => 665677,
            'c' => 915675
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['isPossible' => true]);
    }

    public function testNullInC(ApiTester $I)
    {
        $I->wantTo('Check if a triangle can take null in `c` parameter');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendGet('/triangle/possible', [
            'a' => '-aSd',
            'b' => '-aSd',
            'c' => 0
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => ['error' => 'Not valid data']]);
    }

    public function testIncorrect(ApiTester $I)
    {
        $I->wantTo('Check if a triangle can take incorrect parameters');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendGet('/triangle/possible', [
            'a' => '%%',
            'b' => '%^%^',
            'c' => '-aSd'
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => ['error' => 'Not valid data']]);
    }

    public function testEmpty(ApiTester $I)
    {
        $I->wantTo('Check if a triangle can take empty parameters');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendGet('/triangle/possible', [
            'a' => '',
            'b' => '',
            'c' => ''
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => ['error' => 'Not valid data']]);
    }

    public function testDouble(ApiTester $I)
    {
        $I->wantTo('Check if a triangle can take double or float parameter');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendGet('/triangle/possible', [
            'a' => 3.2,
            'b' => 3.5,
            'c' => 4.3
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => ['error' => 'Not valid data']]);
    }
}
