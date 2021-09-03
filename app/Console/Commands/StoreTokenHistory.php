<?php
namespace App\Console\Commands;

use App\Currency;
use Illuminate\Console\Command;
use App\RateHistory;

class StoreTokenHistory extends Command
{
   /** @var @inheritDoc */
    protected $signature = 'cron:store-token-rate';

    /** @var @inheritDoc */
    protected $description = 'Сохранение истории курса токена';

    /**
     * @inheritDoc
     */
    public function handle()
    {
        RateHistory::create(['rate' => Currency::getRate()]);
    }
}
