<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CompareIndexPerformance extends Command
{
    protected $signature = 'compare:performance {date}';
    protected $description = 'Compare performance of selections by date of birth with different index types';

    public function handle()
    {
        $date = $this->argument('date');

        // Вибірка без індексу
        $start = microtime(true);
        $resultsWithoutIndex = DB::table('accounts')->where('date_of_birth', $date)->get();
        $timeWithoutIndex = microtime(true) - $start;

        // Вибірка з BTREE індексом
        $start = microtime(true);
        $resultsWithBtreeIndex = DB::table('accounts')->where('date_of_birth', $date)->get();
        $timeWithBtreeIndex = microtime(true) - $start;

        // Вибірка з HASH індексом
        $start = microtime(true);
        $resultsWithHashIndex = DB::table('accounts')->where('date_of_birth', $date)->get();
        $timeWithHashIndex = microtime(true) - $start;

        // Виведення результатів
        $this->info("Time without index: " . number_format($timeWithoutIndex, 6) . " seconds");
        $this->info("Time with BTREE index: " . number_format($timeWithBtreeIndex, 6) . " seconds");
        $this->info("Time with HASH index: " . number_format($timeWithHashIndex, 6) . " seconds");
    }
}
