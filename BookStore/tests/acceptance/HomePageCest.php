<?php namespace App\Tests;
use App\Tests\AcceptanceTester;

class HomePageCest
{
    public function homePageContent(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('home page');
    }

    public function homePageLinkToAbout(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->click('ABOUT');
        $I->seeInCurrentUrl('/about');
        $I->see('about');
    }

}
