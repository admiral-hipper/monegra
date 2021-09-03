<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Currency::insertOrIgnore([
            [
                'id' => \App\Currency::RTL,
                'code' => 'RTL',
                'name_ru' => 'RTL',
                'name_en' => 'RTL',
            ],
            [
                'id' => \App\Currency::USD,
                'code' => 'USD',
                'name_ru' => 'USD',
                'name_en' => 'USD',
            ],
            [
                'id' => \App\Currency::BTC,
                'code' => 'BTC',
                'name_ru' => 'BTC',
                'name_en' => 'BTC',
            ],
            [
                'id' => \App\Currency::ETH,
                'code' => 'ETH',
                'name_ru' => 'ETH',
                'name_en' => 'ETH',
            ],
            [
                'id' => \App\Currency::PZM,
                'code' => 'PZM',
                'name_ru' => 'PZM',
                'name_en' => 'PZM',
            ],
            [
                'id' => \App\Currency::XAU,
                'code' => 'XAU',
                'name_ru' => 'XAU',
                'name_en' => 'XAU',
            ],
            [
                'id' => \App\Currency::RGP,
                'code' => 'RGP',
                'name_ru' => 'RGP',
                'name_en' => 'RGP',
            ],
        ]);
    }
}
