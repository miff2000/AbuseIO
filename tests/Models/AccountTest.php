<?php

namespace tests\Models;

use AbuseIO\Models\Account;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use tests\TestCase;

class AccountTest extends TestCase
{
    use DatabaseTransactions;

    public function testModelFactory()
    {
        $account = factory(Account::class)->create();
        $accountFromDB = Account::where('name', $account->name)->first();
        $this->assertEquals($account->name, $accountFromDB->name);
    }

    public function testGetSystemAccount()
    {
        $this->assertTrue(
            Account::getSystemAccount()->is(Account::find(1)),
            var_dump(Account::where('systemaccount', '=', true)->first()->id)
        );
    }

    public function testSetSystemAccount()
    {
        $account = factory(Account::class)->create();
        $account->systemaccount = true;
        $this->assertTrue((bool) Account::find($account->id)->systemaccount);
    }
}
