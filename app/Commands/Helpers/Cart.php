<?php

namespace App\Commands\Helpers;

use Illuminate\Filesystem\Filesystem;

class Cart
{
    private $path;

    private $filesystem;

    public function __construct($path)
    {
        $this->path = $path;
        $this->filesystem = new Filesystem();
    }

    public function getPath($path = DIRECTORY_SEPARATOR)
    {
        return realpath($this->path) . $path;
    }

    public function getPathRelative()
    {
        return $this->path;
    }

    public function validatePath()
    {
        return $this->filesystem->exists($this->getPath('/config.php'));
    }
}
