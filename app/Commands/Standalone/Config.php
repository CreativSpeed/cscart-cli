<?php

namespace App\Commands\Standalone;

use App\Commands\Helpers\MakeFile;
use Illuminate\Support\Facades\Cache;

class Config extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:config';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create config.php for add-on';

    public function getStub()
    {
        return __DIR__ . '/stubs/Config.stub';
    }

    public function getFilename()
    {
        return 'config.php';
    }

    public function getPath()
    {
        return join(DIRECTORY_SEPARATOR, array(cache('addon_path'), 'app', 'addons', cache('addon_name')));
    }
}
