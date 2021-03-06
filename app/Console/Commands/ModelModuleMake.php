<?php

namespace App\Console\Commands;

use components\ModularComponent;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

/**
 * Class ModelModuleMake
 * @package App\Console\Commands
 *
 * @property ModularComponent $modularComponent
 */
class ModelModuleMake extends Command
{
    protected $modularComponent;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module-model {module : Module name} {model : Model name}
                                               {--migration : Only migrate file}
                                                                                ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make model for module';

    /**
     * Create a new command instance.
     * ModelModuleMake constructor.
     * @param ModularComponent $modularComponent
     */
    public function __construct(ModularComponent $modularComponent)
    {
        parent::__construct();
        $this->modularComponent = $modularComponent;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->option('migration')) {
            $this->createMigration();
        }

        $this->createModel();

        return true;
    }

    /**
     * Create model file
     */
    private function createModel()
    {
        try {
            $module = trim($this->argument('module'));
            $model = Str::singular(class_basename(trim($this->argument('model')))); // Якщо Blogs то Blog
            $model = ucfirst (Str::camel($model));

            $this->call('make:model', [
                'name' => "{$this->modularComponent->baseNamespace}\\{$module}\\Models\\{$model}"
            ]);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Create migration file for current model
     * @return int
     */
    private function createMigration()
    {
        try {
            $module = trim($this->argument('module'));
            $model = Str::title(trim($this->argument('model')));
            $model = Str::plural(class_basename($model)); // Якщо Blog то Blogs

            return $this->call('make:module-migration', [
                'module' => $module,
                'migrationName' => "create_{$model}_table",
                'table' => "$model"
            ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
