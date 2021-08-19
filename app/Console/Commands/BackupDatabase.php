<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        // create folder
        $path = storage_path() . "/app/backup/";
        if (!file_exists($path)) {
            Storage::makeDirectory("backup");
        }

        $filename = "backup-" . Carbon::now()->format('Y-m-d-His') . ".gz";

        $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > " . $path . $filename;
        $returnVar = NULL;
        $output  = NULL;
        exec($command, $output, $returnVar);

        Log::info('Backup database');
    }
}
