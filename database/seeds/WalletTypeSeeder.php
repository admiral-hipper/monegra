<?php

use Illuminate\Database\Seeder;

class WalletTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\WalletType::insertOrIgnore([
            [
                'id' => \App\WalletType::PAYEER,
                'currency_id' => \App\Currency::USD,
                'name' => 'Payeer',
                'image_path' => '/images/payeer-logo.png',
            ],
            [
                'id' => \App\WalletType::PM,
                'currency_id' => \App\Currency::USD,
                'name' => 'Perfect Money',
                'image_path' => '/images/perfect-money-logo.png',
            ],
            [
                'id' => \App\WalletType::BTC,
                'currency_id' => \App\Currency::BTC,
                'name' => 'Bitcoin',
                'image_path' => '/images/bitcoin-logo.png',
            ],
            [
                'id' => \App\WalletType::ETH,
                'currency_id' => \App\Currency::ETH,
                'name' => 'Ethereum',
                'image_path' => '/images/ethereum-logo.png',
            ],
            [
                'id' => \App\WalletType::PZM,
                'currency_id' => \App\Currency::PZM,
                'name' => 'Prizm',
                'image_path' => '/images/prizm-logo.png',
            ],
        ]);
    }
}
