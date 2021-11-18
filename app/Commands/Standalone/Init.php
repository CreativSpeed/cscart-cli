<?php

namespace App\Commands\Standalone;

use App\Commands\Helpers\MakeFile;
use Illuminate\Support\Facades\Cache;

class Init extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:init';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create init.php for add-on';

    public function getStub()
    {
        return __DIR__ . '/stubs/Init.stub';
    }

    public function getFilename()
    {
        return 'init.php';
    }

    public function getPath()
    {
        return join(DIRECTORY_SEPARATOR, array(cache('addon_path'), 'app', 'addons', cache('addon_name')));
    }
}
