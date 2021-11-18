<?php

namespace App\Commands\Standalone;

use App\Commands\Helpers\MakeFile;

class Locals extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:local { code=en : Add-on langauge}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create [langauge].po for add-on';

    public function getStub()
    {
        return __DIR__ . '/stubs/Language.stub';
    }

    public function getFilename()
    {
        return cache('addon_name') . '.po';
    }

    public function getPath()
    {
        return join(
            DIRECTORY_SEPARATOR,
            array(cache('addon_path'), 'var', 'langs', $this->argument('code'), 'addons')
        );
    }
}
