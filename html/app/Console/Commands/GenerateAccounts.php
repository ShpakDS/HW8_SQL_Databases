<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Account;
use Illuminate\Support\Facades\DB;

class GenerateAccounts extends Command
{
    protected $signature = 'accounts:generate {count=40000000}';
    protected $description = 'Generate random accounts';

    public function handle()
    {
        ini_set('memory_limit', '-1');

        $count = (int)$this->argument('count');
        $chunkSize = 20000;

        DB::transaction(function () use ($count, $chunkSize) {
            for ($i = 0; $i < $count; $i += $chunkSize) {
                $remaining = $count - $i;
                $currentChunk = min($chunkSize, $remaining);

                $accounts = Account::factory()->count($currentChunk)->make()->toArray();

                Account::insert($accounts);

                $this->info("Inserted $currentChunk accounts. Total: " . ($i + $currentChunk));
            }
        });

        $this->info("All accounts generated successfully.");
    }
}
