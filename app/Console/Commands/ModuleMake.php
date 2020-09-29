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
                                        {--test : Only Test (Feature tests)}
                                        ';
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
            $this->input->setOption('test', true);
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

        if ($this->option('test')) {
            if (!$this->checkResourceParam()) {
                return false;
            }
            $this->createTest();
        }

        $this->makeModule(); // make default module structure
        $this->call('route:clear'); //clear route cache

        $this->info('Module successfully created!!!');

        return true;
    }

    /**
     * Make default module folders,files
     */
    private function makeModule()
    {
        $modulePath = $this->laravel['path'] . "/Modules/" . ModularComponent::MODULE_VERSION . "/{$this->moduleName}";

        $this->makeDirectory($modulePath); // make module directory

        $this->makeDirectory($modulePath . '/Resources/Views'); // make views directory

        $this->makeDirectory($modulePath . '/Tests/Feature');  // make feature tests directory

        $this->makeDirectory($modulePath . '/Tests/Unit');  // make unit tests directory

        $this->makeDirectory($modulePath . '/Routes');  // make routes directory

        $this->files->put($modulePath . '/Routes/web.php', ''); // make web.php file for web routes
        $this->files->put($modulePath . '/Routes/api.php', ''); // make api.php file for api routes

        return true;
    }


    /**
     * @param String $path
     */
    private function makeDirectory(String $path): void
    {
        $this->files->makeDirectory(
            $path,
            0777,
            true,
            true
        );
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
