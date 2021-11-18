<?php

namespace App\Commands\Standalone;

use Illuminate\Support\Str;
use App\Commands\Helpers\MakeFile;

class Controller extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:controller { name : controller filename }, { type=backend : type of controller }';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create controller.php for add-on';

    public function getStub()
    {
        return __DIR__ . '/stubs/Controller.stub';
    }

    public function getFilename()
    {
        return !Str::contains($this->argument('name'), '.php')
        ? $this->argument('name') . '.php'
        : $this->argument('name');
    }

    public function getPath()
    {
        return join(
            DIRECTORY_SEPARATOR,
            array(cache('addon_path'), 'app', 'addons', cache('addon_name'), 'controllers', $this->argument('type'))
        );
    }
}
