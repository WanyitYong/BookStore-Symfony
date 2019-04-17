<?php namespace App\Tests;
use App\Tests\AcceptanceTester;

class UserCest
{
    public function testUserInDb(AcceptanceTester $i)
    {
        $i->seeInRepository('App\Entity\User',['username'=>'user']);
        $i->seeInRepository('App\Entity\User',['username'=>'admin']);
        $i->seeInRepository('App\Entity\User',['username'=>'Matt']);
    }

    public function testAddToDatabase(AcceptanceTester $I)
    {
        $I->haveInRepository('App\Entity\User', [ 'username' => 'userTEMP', 'roles' => ["ROLE_USER"], 'password' => 'sdf' ]);
        $I->seeInRepository('App\Entity\User', [ 'username' => 'userTEMP' ]);
    }

    public function testTEMPNoLongerInDatabase(AcceptanceTester $I)
    {
        $I->dontSeeInRepository('App\Entity\User', [ 'username' => 'userTEMP' ]);
    }
}
