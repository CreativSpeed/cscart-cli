<?php

namespace App\Commands\Standalone;

use App\Commands\Helpers\MakeFile;

class Theme extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'add:file { filename }, { path }, { stub }';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create addon.xml for add-on';

    public function getStub()
    {
        return join(DIRECTORY_SEPARATOR, array(__DIR__, 'stubs', $this->argument('stub')));
    }

    public function getFilename()
    {
        return $this->argument('filename');
    }

    public function getPath()
    {
        return join(DIRECTORY_SEPARATOR, array(cache('addon_path'), $this->argument('path')));
    }
}
