<?php

namespace App\Commands;

use Illuminate\Support\Facades\Cache;
use LaravelZero\Framework\Commands\Command;

class AddonNewCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'addon:new
                            { name : Add-on name [ID] },
                            { path? : Add-on folder location (optional) }
                            { --c|controller : create Add-on controller }
                            { --l|local : change or add Add-on languages }
                            { --t|theme : add var/themes_repository }';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Scaffold a new Cs-Cart & multi-vendor Add-on';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


        $this->task('Managing addon details', function () {
            $this->setArguments();
        });

        $this->task('Creating Add-on files', function () {

            $this->callSilent('create:scheme');
            $this->callSilent('create:func');
            $this->callSilent('create:init');
            $this->callSilent('create:config');
            $this->callSilent('copy:thumbnail');

            if ($this->option('controller')) {
                $controller_type = $this->choice('please set controller type', ['backend', 'frontend', 'common'], 'backend');
                $controller_name = $this->ask('enter you controller filename', strtolower($this->argument('name')) . '.php');
                $this->callSilent('create:controller', array('name' => $controller_name, 'type' => $controller_type));
            }

            if ($this->option('local')) {
                $locals = $this->choice('Add-on support langauges [ar,en,ru..]', app('data')->getLangs(), 'en', null, true);
                $addon_desc = $this->ask('add description for your addon and keep it keep short');

                Cache::forever('addon_description', $addon_desc);

                foreach ($locals as $code) {
                    Cache::forever('lang_code', $code);
                    $this->callSilent('create:local', ['code' => $code]);
                }
            }

            if ($this->option('theme')) {
                $this->callSilent('add:file', [
                    'filename' => 'scripts.post.tpl',
                    'path' => join(DIRECTORY_SEPARATOR, array('var', 'themes_repository', 'responsive', 'templates', 'addons', strtolower(cache('addon_name')), 'hooks', 'index')),
                    'stub' => 'Script.tpl.stub'
                ]);
                $this->callSilent('add:file', [
                    'filename' => 'styles.post.tpl',
                    'path' => join(DIRECTORY_SEPARATOR, array('var', 'themes_repository', 'responsive', 'templates', 'addons', strtolower(cache('addon_name')), 'hooks', 'index')),
                    'stub' => 'Style.tpl.stub'
                ]);
                $this->callSilent('add:file', [
                    'filename' => 'styles.less',
                    'path' => join(DIRECTORY_SEPARATOR, array('var', 'themes_repository', 'responsive', 'css', 'addons', strtolower(cache('addon_name')))),
                    'stub' => 'Empty.stub'
                ]);
                $this->callSilent('add:file', [
                    'filename' => 'func.js',
                    'path' => join(DIRECTORY_SEPARATOR, array('js', 'addons', strtolower(cache('addon_name')))),
                    'stub' => 'FuncJs.stub'
                ]);
            }

        });
    }

    protected function setArguments()
    {
        $this->setAddonName();
        $this->setAddonPath();
    }

    protected function setAddonName()
    {
        $argument = $this->argument('name');
        Cache::forever('addon_name', $argument);
    }

    protected function setAddonPath()
    {
        $path = $this->argument('path') ?? getcwd();
        $path = app()->environment() == 'development'
        ? join(DIRECTORY_SEPARATOR, array($path, 'build', cache('addon_name')))
        : join(DIRECTORY_SEPARATOR, array($path, cache('addon_name')));

        Cache::forever('addon_path', $path);
    }

}
