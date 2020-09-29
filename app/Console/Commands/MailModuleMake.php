<?php

namespace App\Console\Commands;

use components\ModularComponent;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

/**
 * Class MailModuleMake
 * @package App\Console\Commands
 *
 * @property Filesystem $files
 * @property ModularComponent $modularComponent
 */
class MailModuleMake extends Command
{
    protected $modularComponent;

    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module-mail {module} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make mail file for module';

    /**
     * Create a new command instance.
     *
     * MailModuleMake constructor.
     * @param Filesystem $files
     * @param ModularComponent $modularComponent
     */
    public function __construct(Filesystem $files, ModularComponent $modularComponent)
    {
        parent::__construct();
        $this->files = $files;
        $this->modularComponent = $modularComponent;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->createMail();
        return true;
    }

    private function createMail()
    {
        try {
            $module = trim($this->argument('module')); //module name
            $mailModel = Str::singular(class_basename(trim($this->argument('name')))); // Якщо Blogs то Blog
            $mailModel = ucfirst(Str::camel($mailModel));// request model name

            $path = $this->getRequestPath($module, $mailModel);
            $this->makeDirectory($path);

            $stub = $this->files->get(base_path('resources/stubs/mail.stub'));

            $stub = str_replace(
                ['DummyNamespace', 'DummyClass'],
                [
                    "{$this->modularComponent->baseNamespace}\\{$module}\\Mail",
                    $mailModel,
                ],
                $stub
            );
            $this->files->put($path, $stub);
            $this->info('Mail created successfully.');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * @param string $path
     */
    private function makeDirectory(string $path)
    {
        $this->files->makeDirectory(dirname($path), 0777, true, true);
    }

    /**
     * Get Request model path
     * @param $module
     * @param $requestModel
     * @return string
     */
    private function getRequestPath($module, $requestModel)
    {
        return $this->laravel['path'] . "/Modules/" . ModularComponent::MODULE_VERSION . "/{$module}/Mail/{$requestModel}.php";
    }
}
