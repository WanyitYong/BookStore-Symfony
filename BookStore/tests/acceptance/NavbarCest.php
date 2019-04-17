<?php namespace App\Tests;
use App\Tests\AcceptanceTester;
use Codeception\Example;
class NavbarCest
{
    /**
     * @example(url="/", text="home page")
     * @example(url="/about", text="about page")
     */
    public function staticPageContent(AcceptanceTester $I, Example $example)
    {
        $I->amOnPage($example['url']);
        $I->see($example['text']);
    }

    /**
     * @example(url="/", link="HOME")
     * @example(url="/about", link="ABOUT")
     */
    public function staticPageLinks(AcceptanceTester $I, Example $example)
    {
        $I->amOnPage('/');
        $I->click($example['link']);
        $I->seeCurrentUrlEquals($example['url']); // full URL
        $I->seeInCurrentUrl($example['url']); // part of URL
    }
}