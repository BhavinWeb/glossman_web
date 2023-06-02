<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Admin\SettingsController;

class DatabaseBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $filename = "database-backup-" . Carbon::now()->format('Y-m-d-s') . ".gz";

        $directoryPath = storage_path() . "/app/backup/database";
        if (File::isDirectory($directoryPath)) {
        } else {
            File::makeDirectory($directoryPath, 0777, true, true);
        }

        $command = "mysqldump --user=" . config('database.mysql.username') . " --password=" . config('database.mysql.password') . " --host=" . config('database.mysql.host') . " " . config('database.mysql.database') . "  | gzip > " . storage_path() . "/app/backup/database/" . $filename;

        $returnVar = NULL;
        $output  = NULL;

        $path = storage_path() . "/app/backup/database/" . $filename;

        (new SettingsController())->storeBackup($filename, $path);

        exec($command, $output, $returnVar);
    }
}
