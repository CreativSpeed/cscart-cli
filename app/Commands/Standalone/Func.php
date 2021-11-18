<?php

namespace App\Commands\Standalone;

use App\Commands\Helpers\MakeFile;
use Illuminate\Support\Facades\Cache;

class Func extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:func';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create func.php for add-on';

    public function getStub()
    {
        return __DIR__ . '/stubs/Func.stub';
    }

    public function getFilename()
    {
        return 'func.php';
    }

    public function getPath()
    {
        return join(DIRECTORY_SEPARATOR, array(cache('addon_path'), 'app', 'addons', cache('addon_name')));
    }
}
