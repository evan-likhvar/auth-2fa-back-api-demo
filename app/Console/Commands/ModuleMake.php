<?php

namespace App\Console\Commands;

use App\Console\Commands\traits\ModuleMakeTrait;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use components\ModularComponent;

/**
 * Class ModuleMake
 * @package App\Console\Commands
 *
 * @property Filesystem $files
 * @property ModularComponent $moduleComponent
 * @property string $moduleName
 * @property string $resourceName
 */
class ModuleMake extends Command
{
    use ModuleMakeTrait;

    protected $files;

    protected $moduleComponent;

    /** Module name */
    private $moduleName;

    /** Resource file name */
    private $resourceName;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name : module name} {resourceName? : Resource file name}
                                        {--all : All items}
                                        {--model : Only Model}
                                        {--migration : Only migrate file}
                                        {--controller : Only Controller}
                                        {--request : Only request}
                                        {--seed : Only Seed}
                                        {--resource : Only collection resource}
                                        {--mail : Only mail}
                                        ';

//{--view : Only view}
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
        $this->moduleComponent = new ModularComponent();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->moduleName = trim($this->argument('name'));
        $this->resourceName = $this->setResourceName();

        if (!in_array($this->moduleName, $this->moduleComponent->getModules())) {
            $this->error('You must set your new component name to modular config! Path to config is ' . base_path('config\modular.php'));

            return false;
        }

        if ($this->option('all')) {
            $this->input->setOption('model', true);
            $this->input->setOption('migration', true);
            $this->input->setOption('controller', true);
            $this->input->setOption('request', true);
            $this->input->setOption('seed', true);
            $this->input->setOption('resource', true);
            $this->input->setOption('mail', true);
        }


        if ($this->option('model')) {
            if (!$this->checkResourceParam()) {
                return false;
            }
            $this->createModel();
        }

        if ($this->option('migration')) {
            if (!$this->checkResourceParam()) {
                return false;
            }
            $this->createMigration();
        }

        if ($this->option('controller')) {
            if (!$this->checkResourceParam()) {
                return false;
            }
            $this->createController();
        }

        if ($this->option('request')) {
            if (!$this->checkResourceParam()) {
                return false;
            }
            $this->createRequest();
        }

        if ($this->option('seed')) {
            if (!$this->checkResourceParam()) {
                return false;
            }
            $this->createSeed();
        }

        if ($this->option('resource')) {
            if (!$this->checkResourceParam()) {
                return false;
            }
            $this->createResource();
        }

        if ($this->option('mail')) {
            if (!$this->checkResourceParam()) {
                return false;
            }
            $this->createMail();
        }

        $this->files->makeDirectory(
            $this->laravel['path'] . "/Modules/" . ModularComponent::MODULE_VERSION . "/{$this->moduleName}",
            0777,
            true,
            true
        );

        return true;
    }

    /**
     * Check on required param for creating resource
     * @return bool
     */
    private function checkResourceParam()
    {
        if (!$this->resourceName) {
            $this->error('Param resourceName is required!');

            return false;
        }

        return true;
    }

    /**
     * Prepare resource name
     * @return string|null
     */
    private function setResourceName()
    {
        $resourceName = $this->argument('resourceName');
        if (!$resourceName) {
            return null;
        }

        $resourceName = Str::singular(class_basename(trim($resourceName))); // Якщо Blogs то Blog
        return ucfirst($resourceName);
    }
}
