<?php

namespace App\Commands\Standalone;

use App\Commands\Helpers\CopyFile;

class Thumbnail extends CopyFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'copy:thumbnail';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'generate Add-on image thumbnail';

    public function getFilename()
    {
        return 'icon.png';
    }

    public function getSource()
    {
        return base_path('resources');
    }

    public function getPath()
    {
        return join(DIRECTORY_SEPARATOR, array(cache('addon_path'), 'design', 'backend', 'media', 'images', 'addons', cache('addon_name')));
    }
}
