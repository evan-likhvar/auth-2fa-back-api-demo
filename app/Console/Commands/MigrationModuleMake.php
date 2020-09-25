<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MigrationModuleMake extends Command
{
    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module-migration 
                                        {module : Module name} 
                                        {migrationName : Migration file name} 
                                        {table : Table name}
                                        ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make migration file for module';

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
        $this->createMigration();
    }

    private function createMigration()
    {
        $moduleName = trim($this->argument('module'));
        $migrationPath = "app\Modules\\v1\\{$moduleName}\\migrations\\";

        $table = Str::snake(class_basename($this->argument('table')));
        $table = Str::plural($table);

        $migrationName = Str::lower(trim($this->argument('migrationName'))) .'_'. time();

        try {
            $this->call('make:migration', [
                'name' => $migrationName,
                '--create' => $table,
                '--path' => $migrationPath
            ]);

        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
