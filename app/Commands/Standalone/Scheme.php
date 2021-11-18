<?php

namespace App\Commands\Standalone;

use App\Commands\Helpers\MakeFile;

class Scheme extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:scheme';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create addon.xml for add-on';

    public function getStub()
    {
        return __DIR__ . '/stubs/AddonXml.stub';
    }

    public function getFilename()
    {
        return 'addon.xml';
    }

    public function getPath()
    {
        return join(DIRECTORY_SEPARATOR, array(cache('addon_path'), 'app', 'addons', cache('addon_name')));
    }
}
