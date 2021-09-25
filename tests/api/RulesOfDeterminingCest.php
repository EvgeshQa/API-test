<?php

class RulesOfDeterminingCest
{
    public function testEquilateral(ApiTester $I)
    {
        $I->wantTo('Check if a triangle can take the same sides');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendGet('/triangle/possible', [
            'a' => '3',
            'b' => '3',
            'c' => '3'
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['isPossible' => true]);
    }

    public function testHypotenuse (ApiTester $I)
    {
        $I->wantTo('Check if a triangle can take the hypotenuse is less than the sum of the catheter');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendGet('/triangle/possible', [
            'a' => '3',
            'b' => '5',
            'c' => '2'
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['isPossible' => false]);

        $I->sendGet('/triangle/possible', [
            'a' => '2',
            'b' => '3',
            'c' => '5'
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['isPossible' => false]);
    }

    public function testNotPossible(ApiTester $I)
    {
        $I->wantTo('Check if a triangle cannot take the sum of the catheter less than hypotenuse');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendGet('/triangle/possible', [
            'a' => '2',
            'b' => '3',
            'c' => '8'
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['isPossible' => false]);
    }
}
