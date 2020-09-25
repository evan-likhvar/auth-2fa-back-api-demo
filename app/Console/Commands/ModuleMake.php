<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ModuleMake extends Command
{
    protected $files;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}
                                        {--all : All items}
                                        {--migration : Only migrate file}
                                        {--view : Only view}
                                        {--model : Only Model}                           
                                        ';

//{--controller : Only view}
//{--repository : Only view}
//{--mail : Only view}
//{--request : Only view}
//{--test : Only view}
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make module';

    /**
     * Create a new command instance.
     *
     * @param Filesystem $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->option('all')) {
            $this->input->setOption('migration', true);
            $this->input->setOption('view', true);
            $this->input->setOption('model', true);
        }

        if ($this->option('model')) {
            $this->createModel();
        }

        if ($this->option('migration')) {
            $this->createMigration();
        }

        if ($this->option('view')) {
            $this->createView();
        }
    }

    /**
     * Example - php artisan make:module ModuleName\ModelName --model
     */
    private function createModel()
    {
        try {
            $nameArgument = trim($this->argument('name'));
            $model = Str::singular(class_basename($nameArgument)); // Якщо Blogs то Blog

            $argumentChunks = explode('\\', $nameArgument);
            if (count($argumentChunks) > 1) {
                array_pop($argumentChunks);
                $nameArgument = implode('\\', $argumentChunks);
            }

            $this->call('make:model', [
                'name' => "App\\Modules\\v1\\{$nameArgument}\\Models\\{$model}"
            ]);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    private function createMigration()
    {

        $table = Str::snake(class_basename($this->argument('name')));
        $table = Str::plural($table);
        dd($this->argument('name'));

        try {
            $this->call('make:migration', [
                'name' => "create_{$table}_table",
                '--create' => $table,
                '--path' => 'App\\Modules\\v1\\'.$table
            ]);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    private function createView()
    {
        //TODO CREATE VIEW
    }
}
