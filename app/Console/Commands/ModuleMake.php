<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
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
                                        {--migration : Only migrate}
                                        {--view : Only view}
                                        {--model : Only view}
                                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
            $this->input->setOption('migration', true);
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

    private function createModel()
    {
        //TODO CREATE MODEL
    }

    private function createMigration()
    {
        //TODO CREATE MIGRATION
    }

    private function createView()
    {
        //TODO CREATE VIEW
    }
}
