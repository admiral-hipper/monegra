<?php

namespace Tests\Feature;

use App\Transaction;
use App\TransactionType;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testMakeReferralsAccrual()
    {
        /** @var User[] $usersTree */
        $usersTree = [];
        for ($depth = 0; $depth < 10; $depth++) {
            /** @var User $user */
            $user = factory(User::class)->create();

            /** @var User $parent */
            if (isset($parent)) {
                $parent->appendNode($user);
            }

            $parent = $user;
            $usersTree[$user->id] = $user;
        }

        $user->makeReferralsAccrual(100);

        $balances = [
            1 => 0.00000000,
            2 => 0.00000100,
            3 => 0.00001000,
            4 => 0.00010000,
            5 => 0.00100000,
            6 => 0.01000000,
            7 => 0.10000000,
            8 => 1.00000000,
            9 => 10.00000000,
            10 => 0.00000000,
        ];

        foreach ($balances as $id => $balance) {
            $usersTree[$id]->refresh();
            $this->assertEquals($balance, $usersTree[$id]->balance_token);
            if ($balance) {
                $this->assertDatabaseHas('transactions', [
                    'user_id' => $id,
                    'type_id' => TransactionType::DEPOSIT_REF_BONUS,
                    'balance_token_amount' => $balance,
                ]);
            }
        }
    }

//    public function testMakeRankAccrual()
//    {
//
//    }
//
//    public function testUpdateBalance()
//    {
//
//    }
//
//    public function testGenerateRefCode()
//    {
//
//    }
//
    public function testMakeDailyAccrual()
    {
        /** @var User $user */
        $user = factory(User::class)->create(['balance_token_deposit' => 1000]);
        $user->makeDailyAccrual();
        $user->refresh();
        $this->assertEquals(1000.10000000, $user->balance_token_deposit);
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'type_id' => TransactionType::DEPOSIT_DAILY_ACCRUAL,
            'balance_token_amount' => 0.00000000,
            'balance_token_deposit_amount' => 0.10000000,
        ]);

        /** @var User $user */
        $user = factory(User::class)->create(['balance_token_deposit' => 1000]);
        $user->makeDailyAccrual(50 / 10000);
        $user->refresh();
        $this->assertEquals(1005.00000000, $user->balance_token_deposit);
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'type_id' => TransactionType::DEPOSIT_DAILY_ACCRUAL,
            'balance_token_amount' => 0.00000000,
            'balance_token_deposit_amount' => 5.00000000,
        ]);

        /** @var User $userParent */
        $userParent = factory(User::class)->create();
        /** @var User $user */
        $user = factory(User::class)->create(['balance_token' => 500, 'balance_token_deposit' => 900]);
        $userParent->appendNode($user);
        $transaction2D = $user->updateBalance(TransactionType::MOVE_TO_DEPOSIT, 100);
        $transaction2D->created_at = $transaction2D->created_at->subDays(2);
        $transaction2D->apply();
        $transaction1D = $user->updateBalance(TransactionType::MOVE_TO_DEPOSIT, 100);
        $transaction1D->created_at = $transaction1D->created_at->subDays(1);
        $transaction1D->apply();
        $transaction0D = $user->updateBalance(TransactionType::MOVE_TO_DEPOSIT, 100);
        $transaction0D->apply();
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'type_id' => TransactionType::MOVE_TO_DEPOSIT,
            'balance_token_amount' => -100.00000000,
            'balance_token_deposit_amount' => 100.00000000,
            'status' => Transaction::STATUS_SUCCESS,
        ]);
        $user->refresh();
        $user->makeDailyAccrual(50 / 10000);
        $user->refresh();
        $this->assertEquals(1205.00000000, $user->balance_token_deposit);
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'type_id' => TransactionType::DEPOSIT_DAILY_ACCRUAL,
            'balance_token_amount' => 0.00000000,
            'balance_token_deposit_amount' => 5.00000000,
        ]);
        $this->assertDatabaseHas('transactions', [
            'user_id' => $userParent->id,
            'type_id' => TransactionType::DEPOSIT_REF_BONUS,
            'balance_token_amount' => 0.50000000,
            'balance_token_deposit_amount' => 0.00000000,
        ]);
    }
}
