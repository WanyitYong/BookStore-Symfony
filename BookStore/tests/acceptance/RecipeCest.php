<?php namespace App\Tests;
use App\Tests\AcceptanceTester;

class RecipeCest
{
    public function tryToTest(AcceptanceTester $i)
    {
        $i->amOnPage('/login');
        $i->fillField('#inputUsername', 'user');
        $i->fillField('#inputPassword', 'user');
        $i->click('Log in');
    }
}
