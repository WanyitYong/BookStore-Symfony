<?php namespace App\Tests;
use App\Tests\AcceptanceTester;

class UserCest
{
    public function testUserInDb(AcceptanceTester $i)
    {
        $i->haveInRepository('App\Entity\User',['username'=>'user']);
        $i->seeInRepository('App\Entity\User',['username'=>'admin']);
        $i->seeInRepository('App\Entity\User',['username'=>'Matt']);
    }

    public function testAddToDatabase(AcceptanceTester $I)
    {
        $I->haveInRepository('App\Entity\User', [ 'username' => 'userTEMP', 'password' => 'sdf', 'roles' => ['ROLE_USER'] ]);
        $I->seeInRepository('App\Entity\User', [ 'username' => 'userTEMP' ]);
    }

    public function testTEMPNoLongerInDatabase(AcceptanceTester $I)
    {
        $I->dontSeeInRepository('App\Entity\User', [ 'username' => 'userTEMP' ]);
    }
}
